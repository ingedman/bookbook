<?php

namespace Tests\Unit\Database;

use App\Book;
use App\Review;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Unit\DatabaseTest;

class UserTest extends DatabaseTest
{
    /** @test */
    public function can_create_and_retrieve_user()
    {
        factory(User::class)->create(['name' => 'Eslam Fakhry']);
        $this->assertDatabaseHas('users', ['name' => 'Eslam Fakhry']);
        $this->assertCount(1, User::all());
    }

    /** @test */
    public function can_create_and_retrieve_reviews_of_user()
    {
        $user = factory(User::class)->create([
            'name' => 'Eslam Fakhry'
        ]);
        factory(\App\Review::class)->create([
            'reviewer_id' => $user->id,
            'book_id' => 1,
            'title' => 'Why 1984 is so great'
        ]);
        factory(\App\Review::class)->create([
            'reviewer_id' => $user->id,
            'book_id' => 2,
            'title' => 'What I hated about dream of rabbit'
        ]);
        factory(\App\Review::class)->create();
        $retrievedUser = User::find($user->id);
        $this->assertCount(
            2,
            $retrievedUser->reviews,
            'Retrieved reviews count did not match');

        $this->assertEquals(
            'Why 1984 is so great',
            $retrievedUser->reviews[0]['title'],
            'First review title did not match'
        );
    }

    /** @test */
    public function can_create_and_retrieve_books_of_user(){
        $user = factory(User::class)->create([
            'name' => 'Eslam Fakhry'
        ]);
        factory(\App\Book::class)->create([
            'poster_id' => $user->id,
            'title' => 'War and Peace'
        ]);
        factory(\App\Book::class)->create([
            'poster_id' => $user->id,
            'title' => 'The Odyssey'
        ]);

        factory(\App\Book::class)->create();

        $retrievedUser = User::find($user->id);
        $this->assertCount(
            2,
            $retrievedUser->postedBooks,
            'Retrieved books count did not match');

        $this->assertEquals(
            'War and Peace',
            $retrievedUser->postedBooks[0]['title'],
            'First book name did not match'
        );
    }

    /** @test */
    public function can_create_and_retrieve_comments_of_user(){
        $user = factory(User::class)->create([
            'name' => 'Eslam Fakhry'
        ]);
        factory(\App\Comment::class)->create([
            'user_id' => $user->id,
            'comment'=>'good job bro'
        ]);

        factory(\App\Comment::class)->create([
            'user_id' => $user->id,
        ]);

        factory(\App\Comment::class)->create();

        $retrievedUser = User::find($user->id);
        $this->assertCount(
            2,
            $retrievedUser->comments,
            'Retrieved comments count did not match');

        $this->assertEquals(
            'good job bro',
            $retrievedUser->comments[0]['comment'],
            'First comment did not match'
        );
    }

    /** @test */
    public function can_create_and_retrieve_reports_by_user(){
        $user = factory(User::class)->create([
            'name' => 'Eslam Fakhry'
        ]);
        factory(\App\Report::class)->create([
            'reporter_id' => $user->id,
            'content'=>'it was offensive'
        ]);

        factory(\App\Report::class)->create([
            'reporter_id' => $user->id,
        ]);

        factory(\App\Report::class)->create();

        $retrievedUser = User::find($user->id);
        $this->assertCount(
            2,
            $retrievedUser->reported,
            'Retrieved reports count did not match');

        $this->assertEquals(
            'it was offensive',
            $retrievedUser->reported[0]['content'],
            'First report content did not match'
        );
    }

    /** @test */
    public function can_create_and_retrieve_reports_to_user(){
        $user = factory(User::class)->create([
            'name' => 'Eslam Fakhry'
        ]);
        factory(\App\Report::class)->create([
            'reportable_type' => User::class,
            'reportable_id' => $user->id,
            'content'=>'they were unfair'
        ]);

        factory(\App\Report::class)->create([
            'reportable_type' => User::class,
            'reportable_id' => $user->id,
        ]);

        factory(\App\Report::class)->create();

        $retrievedUser = User::find($user->id);
        $this->assertCount(
            2,
            $retrievedUser->reports,
            'Retrieved reports count did not match');

        $this->assertEquals(
            'they were unfair',
            $retrievedUser->reports[0]['content'],
            'First report content did not match'
        );
    }

    /** @test */
    public function can_create_and_retrieve_languages_of_user(){
        $user = factory(User::class)->create([
            'name' => 'Eslam Fakhry'
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


        factory(\App\Language::class)->create();

        $retrievedUser = User::find($user->id);
        $retrievedUser->languages()->attach($english);
        $retrievedUser->languages()->attach($spanish);


        $this->assertCount(
            2,
            $retrievedUser->languages,
            'Retrieved languages count did not match');


        $this->assertEquals(
            'english',
            $retrievedUser->languages[0]['name'],
            'First language name did not match'
        );

        $this->assertEmpty(
            $retrievedUser->nativeLanguage,
            'the nativeLanguage did not return empty collection');

    }

    /** @test */
    public function can_create_and_retrieve_native_language_of_user(){
        $user = factory(User::class)->create([
            'name' => 'Eslam Fakhry'
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


        factory(\App\Language::class)->create();

        $retrievedUser = User::find($user->id);
        $retrievedUser->languages()->attach($arabic, ['is_primary'=>true]);

        $this->assertEquals(
            'arabic',
            $retrievedUser->nativeLanguage[0]['name'],
            'the nativeLanguage did not match');

    }

    /** @test */
    public function user_can_follow_other_user(){
        $user1 = factory(User::class)->create([
            'name' => 'Eslam Fakhry'
        ]);

        $user2 = factory(User::class)->create([
            'name' => 'John Doe'
        ]);

        $user3 = factory(User::class)->create([
            'name' => 'Ahmed Khalid'
        ]);


        $user1->followers()->attach($user2);
        $user1->followers()->attach($user3);

        $user2->followers()->attach($user1);


        $this->assertEquals(
            'John Doe',
            $user1->followers[0]->name,
            'the follower name did not match');

        $this->assertEquals(
            'Eslam Fakhry',
            $user2->followings[0]->name,
            'the followed name did not match');

        $this->assertCount(
            2,
            $user1->followers,
            'the followers count did not match');
        $this->assertCount(
            1,
            $user1->followings,
            'the followed count did not match');






    }
}
