<?php

namespace Tests\Integration\Database;

use App\Book;
use App\Comment;
use App\Reaction;
use App\Review;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Integration\DatabaseTest;

class ReactionTest extends DatabaseTest
{
    /** @test */
    public function retrieve_reactionable_review(){
        $review = factory(Review::class)->create([
            'title' => 'About War and Peace'
        ]);
        factory(Reaction::class)->create([
            'reactionable_type'=>Review::class,
            'reactionable_id'=>$review->id,


        ]);

        $this->assertInstanceOf(
            Review::class,
                    Reaction::all()[0]->reactionable,
            'reactionable method did not return a Review'
            );

        $this->assertEquals(
            'About War and Peace',
            Reaction::all()[0]->reactionable->title,
            'review title did not match'
        );
    }

    /** @test */
    public function retrieve_reactionable_book(){
        $book = factory(Book::class)->create([
            'title' => 'War and Peace'
        ]);
        factory(Reaction::class)->create([
            'reactionable_type'=>Book::class,
            'reactionable_id'=>$book->id,
        ]);

        $this->assertInstanceOf(
            Book::class,
                    Reaction::all()[0]->reactionable,
            'reactionable method did not return a Book'

            );
        $this->assertEquals(
            'War and Peace',
            Reaction::all()[0]->reactionable->title,
            'Book title did not match'
        );
    }
    /** @test */
    public function retrieve_reactionable_comment(){
        $comment = factory(Comment::class)->create([
            'comment' => 'great work'
        ]);
        factory(Reaction::class)->create([
            'reactionable_type'=>Comment::class,
            'reactionable_id'=>$comment->id,


        ]);

        $this->assertInstanceOf(
            Comment::class,
                    Reaction::all()[0]->reactionable,
            'reactionable method did not return a Comment'

            );
        $this->assertEquals(
            'great work',
            Reaction::all()[0]->reactionable->comment,
            'comment content did not match'
        );
    }


    /** @test */
    public function retrieve_user_of_reaction(){
        $user = factory(User::class)->create(['name' => 'Eslam Fakhry']);

        factory(Reaction::class)->create([
            'user_id' =>$user->id
        ]);

        $this->assertInstanceOf(
            User::class,
            Reaction::all()[0]->user,
            'user method did not return a User'

        );
        $this->assertEquals(
            'Eslam Fakhry',
            Reaction::all()[0]->user->name,
            'user name did not match'
        );
    }
}
