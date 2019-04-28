<?php

namespace Tests\Integration\Database;

use App\Book;
use App\Language;
use App\Review;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Integration\DatabaseTest;

class LanguageTest extends DatabaseTest
{
    /** @test */
    public function retrieve_books_in_language(){
        $language = factory(Language::class)->create([
            'name' => 'English'
        ]);
        $book1 = factory(Book::class)->create([
            'title' => 'War and Peace'
        ]);
        $book2 = factory(Book::class)->create([
            'title' => 'Divergent'
        ]);
        $language->books()->attach($book1);
        $language->books()->attach($book2);

        $this->assertCount(
            2,
            Language::all()[0]->books,
            'books count did not match'
            );

        $this->assertEquals(
            'War and Peace',
            Language::all()[0]->books[0]->title,
            'first book name did not match'
            );

        $this->assertEquals(
            'Divergent',
            Language::all()[0]->books[1]->title,
            'second book name did not match'
            );

    }

    /** @test */
    public function retrieve_users_in_language(){
        $language = factory(Language::class)->create([
            'name' => 'English'
        ]);
        $user1 = factory(User::class)->create([
            'name' => 'Eslam Fakhry'
        ]);
        $user2 = factory(User::class)->create([
            'name' => 'John Doe'
        ]);
        $language->users()->attach($user1);
        $language->users()->attach($user2);

        $this->assertCount(
            2,
            Language::all()[0]->users,
            'users count did not match'
            );

        $this->assertEquals(
            'Eslam Fakhry',
            Language::all()[0]->users[0]->name,
            'first user name did not match'
            );

        $this->assertEquals(
            'John Doe',
            Language::all()[0]->users[1]->name,
            'second user name did not match'
            );

    }

    /** @test */
    public function retrieve_users_in_reviews(){
        $language = factory(Language::class)->create([
            'name' => 'English'
        ]);
        $review1 = factory(Review::class)->create([
            'title' => 'Why you should read 1994'
        ]);
        $review2 = factory(Review::class)->create([
            'title' => 'the beauty of first person perspective in Divergent'
        ]);
        $language->reviews()->attach($review1);
        $language->reviews()->attach($review2);

        $this->assertCount(
            2,
            Language::all()[0]->reviews,
            'reviews count did not match'
            );

        $this->assertEquals(
            'Why you should read 1994',
            Language::all()[0]->reviews[0]->title,
            'first review title did not match'
            );

        $this->assertEquals(
            'the beauty of first person perspective in Divergent',
            Language::all()[0]->reviews[1]->title,
            'second review title did not match'
            );

    }
}
