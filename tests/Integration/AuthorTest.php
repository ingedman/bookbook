<?php

namespace Tests\Integration\Database;

use App\Author;
use App\Book;
use App\Report;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Integration\DatabaseTest;

class AuthorTest extends DatabaseTest
{
    /** @test */
    public function author_name_gets_trimmed(){
        factory(Author::class)->create([
            'name'=>'  Eslam Fakhry  '
        ]);

        $this->assertEquals(
            'Eslam Fakhry',
            Author::all()[0]->name,
            "name did not get trimmed"
        );

    }

    /** @test */
    public function can_retrieve_books_of_author()
    {
        $book1 = factory(Book::class)->create([
            'title' => 'War and Peace'
        ]);
        $book2 = factory(Book::class)->create([
            'title' => 'The Great Wall'
        ]);

        $author = factory(Author::class)->create();

        $author->books()->attach($book1);
        $author->books()->attach($book2);

        $this->assertCount(
            2,
            Author::find($author->id)->books,
            'Book books count did not match'
        );
        $this->assertEquals(
            'War and Peace',
            Author::find($author->id)->books[0]->title,
            'Author first book name did not match'
        );
        $this->assertEquals(
            'The Great Wall',
            Author::find($author->id)->books[1]->title,
            'Author second book name did not match'
        );

    }

    /** @test */
    public function can_retrieve_reports_of_Author(){
        $author = factory(Author::class)->create();

        factory(Report::class)->create([
            'reportable_id' => $author->id,
            'reportable_type' => Author::class,
            'content'=>'he is not a real person'
        ]);
        factory(Report::class)->create([
            'reportable_id' => $author->id,
            'reportable_type' => Author::class,
            'content' =>'there is a typo in his name'
        ]);
        $this->assertCount(
            2,
            Author::find($author->id)->reports,
            'Author reports count did not match'
        );
        $this->assertEquals(
            'he is not a real person',
            Author::find($author->id)->reports[0]->content,
            'Author first report content did not match'
        );
        $this->assertEquals(
            'there is a typo in his name',
            Author::find($author->id)->reports[1]->content,
            'Author second report content did not match'
        );
    }


}
