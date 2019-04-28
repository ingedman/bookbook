<?php

namespace Tests\Integration\Database;

use App\Author;
use App\Book;
use App\Report;
use App\Review;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Integration\DatabaseTest;

class BookTest extends DatabaseTest
{
    /** @test */
    public function book_unique_slug_automatically_generated()
    {
        $book1 = factory(Book::class)->create([
            'title' => 'War and Peace'
        ]);
        $book2 = factory(Book::class)->create([
            'title' => 'War and Peace'
        ]);

        $this->assertEquals(
            'war-and-peace',
            Book::find($book1->id)->slug,
            "the book slug did not match"
        );

        $this->assertNotEquals(
            'war-and-peace',
            Book::find($book2->id)->slug,
            "the second book slug is not unique"
        );

    }

    /** @test */
    public function can_retrieve_poster_of_book()
    {
        $user = factory(User::class)->create(['name' => 'Eslam Fakhry']);
        $book = factory(Book::class)->create([
            'poster_id' => $user->id,
            'title' => 'War and Peace'
        ]);

        $this->assertEquals('Eslam Fakhry',
            Book::find($book->id)->poster->name,
            'poster name of the book did not match'
        );


    }

    /** @test */
    public function can_retrieve_authors_of_book()
    {
        $book = factory(Book::class)->create([
            'title' => 'War and Peace'
        ]);
        $author = factory(Author::class)->create([
            'name' => 'Leo Tolstoy'
        ]);
        $book->authors()->attach($author);

        $this->assertCount(
            1,
            $book->authors,
            'Book authors count did not match'
        );
        $this->assertEquals(
            'Leo Tolstoy',
            Book::find($book->id)->authors[0]->name,
            'Book first author name did not match'

        );

    }
    /** @test */
    public function can_retrieve_multiple_authors_of_book()
    {
        $book = factory(Book::class)->create([
            'title' => 'War and Peace'
        ]);
        $author1 = factory(Author::class)->create([
            'name' => 'Leo Tolstoy'
        ]);
        $author2 = factory(Author::class)->create([
            'name' => 'George R R Martin'
        ]);
        $book->authors()->attach($author1);
        $book->authors()->attach($author2);

        $this->assertCount(
            2,
            Book::find($book->id)->authors,
            'Book authors count did not match'
        );
        $this->assertEquals(
            'Leo Tolstoy',
            Book::find($book->id)->authors[0]->name,
            'Book first author name did not match'
        );
        $this->assertEquals(
            'George R R Martin',
            Book::find($book->id)->authors[1]->name,
            'Book second author name did not match'
        );

    }

    /** @test */
    public function can_retrieve_reviews_of_book(){
        $book = factory(Book::class)->create([
            'title' => 'War and Peace'
        ]);
        $review1 = factory(Review::class)->create([
            'book_id' => $book->id,
            'title'=>'what is that with War and Peace'
        ]);
        $review2 = factory(Review::class)->create([
            'book_id' => $book->id,
            'title' =>'The great War and Peace book'
        ]);
        $this->assertCount(
            2,
            Book::find($book->id)->reviews,
            'Book reviews count did not match'
        );
        $this->assertEquals(
            'what is that with War and Peace',
            Book::find($book->id)->reviews[0]->title,
            'Book first review title did not match'
        );
        $this->assertEquals(
            'The great War and Peace book',
            Book::find($book->id)->reviews[1]->title,
            'Book second review title did not match'
        );
    }

    /** @test */
    public function can_retrieve_reports_of_book(){
        $book = factory(Book::class)->create();

        factory(Report::class)->create([
            'reportable_id' => $book->id,
            'reportable_type' => Book::class,
            'content'=>'this is not a real book'
        ]);
        factory(Report::class)->create([
            'reportable_id' => $book->id,
            'reportable_type' => Book::class,
            'content' =>'this is not the real author of the book'
        ]);
        $this->assertCount(
            2,
            Book::find($book->id)->reports,
            'Book reports count did not match'
        );
        $this->assertEquals(
            'this is not a real book',
            Book::find($book->id)->reports[0]->content,
            'Book first report content did not match'
        );
        $this->assertEquals(
            'this is not the real author of the book',
            Book::find($book->id)->reports[1]->content,
            'Book second report content did not match'
        );
    }


    /** @test */
    public function can_retrieve_languages_of_book(){
        $book = factory(Book::class)->create([
            'title' => 'War and Peace'
        ]);

        $arabic = factory(\App\Language::class)->create([
            'name'=>'arabic'
        ]);

        $english = factory(\App\Language::class)->create([
            'name'=>'english'

        ]);

        $spanish = factory(\App\Language::class)->create([
            'name'=>'spanish'

        ]);

        $book->languages()->attach($arabic,['is_primary'=>true]);
        $book->languages()->attach($english);
        $book->languages()->attach($spanish);


        $this->assertCount(
            3,
            Book::find($book->id)->languages,
            'Book languages count did not match'
        );

        $this->assertCount(
            1,
            Book::find($book->id)->nativeLanguage,
            'Book  native language count did not match'
        );


    }

    /** @test */
    public function book_title_will_be_trimmed(){
        factory(Book::class)->create([
            'title'=>'  great one  '
        ]);

        $this->assertEquals(
            'great one',
            Book::all()[0]->title,
            "title did not get trimmed"
        );

    }


}
