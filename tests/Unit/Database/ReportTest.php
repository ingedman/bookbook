<?php

namespace Tests\Unit\Database;

use App\Book;
use App\Comment;
use App\Report;
use App\Review;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Unit\DatabaseTest;

class ReportTest extends DatabaseTest
{
    /** @test */
    public function retrieve_reportable_review(){
        $review = factory(Review::class)->create([
            'title' => 'About War and Peace'
        ]);
        factory(Report::class)->create([
            'reportable_type'=>Review::class,
            'reportable_id'=>$review->id,


        ]);

        $this->assertInstanceOf(
            Review::class,
            Report::all()[0]->reportable,
            'reportable method did not return a Review'
        );

        $this->assertEquals(
            'About War and Peace',
            Report::all()[0]->reportable->title,
            'review title did not match'
        );
    }

    /** @test */
    public function retrieve_reportable_book(){
        $book = factory(Book::class)->create([
            'title' => 'War and Peace'
        ]);
        factory(Report::class)->create([
            'reportable_type'=>Book::class,
            'reportable_id'=>$book->id,
        ]);

        $this->assertInstanceOf(
            Book::class,
            Report::all()[0]->reportable,
            'reportable method did not return a Book'

        );
        $this->assertEquals(
            'War and Peace',
            Report::all()[0]->reportable->title,
            'Book title did not match'
        );
    }
    /** @test */
    public function retrieve_reportable_comment(){
        $comment = factory(Comment::class)->create([
            'comment' => 'great work'
        ]);
        factory(Report::class)->create([
            'reportable_type'=>Comment::class,
            'reportable_id'=>$comment->id,


        ]);

        $this->assertInstanceOf(
            Comment::class,
            Report::all()[0]->reportable,
            'reportable method did not return a Comment'

        );
        $this->assertEquals(
            'great work',
            Report::all()[0]->reportable->comment,
            'comment content did not match'
        );
    }


    /** @test */
    public function retrieve_user_of_report(){
        $user = factory(User::class)->create(['name' => 'Eslam Fakhry']);

        factory(Report::class)->create([
            'reporter_id' =>$user->id
        ]);

        $this->assertInstanceOf(
            User::class,
            Report::all()[0]->reporter,
            'reporter method did not return a User'

        );
        $this->assertEquals(
            'Eslam Fakhry',
            Report::all()[0]->reporter->name,
            'reporter name did not match'
        );
    }
}
