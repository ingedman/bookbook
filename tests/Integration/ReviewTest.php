<?php

namespace Tests\Integration\Database;

use App\Book;
use App\Comment;
use App\Language;
use App\Report;
use App\Review;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Integration\DatabaseTest;

class ReviewTest extends DatabaseTest
{

    /** @test */
    public function review_unique_slug_automatically_generated(){
        $review1 = factory(Review::class)->create([
            'title' => 'About War and Peace'
        ]);
        $review2 = factory(Review::class)->create([
            'title' => 'About War and Peace'
        ]);

        $this->assertEquals(
            'about-war-and-peace',
            Review::find($review1->id)->slug,
            "the review slug did not match"
        );

        $this->assertNotEquals(
            'about-war-and-peace',
            Review::find($review2->id)->slug,
            "the second review slug is not unique"
        );

    }

    /** @test */
    public function can_retrieve_reviewer_of_review()
    {
        $user = factory(User::class)->create(['name' => 'Eslam Fakhry']);
        $review = factory(Review::class)->create([
            'reviewer_id' => $user->id,
        ]);

        $this->assertEquals('Eslam Fakhry',
            Review::find($review->id)->reviewer->name,
            'reviewer name did not match'
        );
    }


    /** @test */
    public function can_retrieve_book_of_review(){
        $book = factory(Book::class)->create([
            'title' => 'War and Peace'
        ]);
        $review = factory(Review::class)->create([
            'book_id' => $book->id,
        ]);

        $this->assertEquals(
            'War and Peace',
            Review::find($review->id)->book->title,
            'Book title did not match'
        );

    }

    /** @test */
    public function can_retrieve_comments_of_review(){

        $review = factory(Review::class)->create();

        factory(Comment::class)->create([
            'commentable_id' => $review->id,
            'commentable_type' => Review::class,
            'comment'=>'great job bro'
        ]);
        factory(Comment::class)->create([
            'commentable_id' => $review->id,
            'commentable_type' => Review::class,
            'comment' =>'keep it up'
        ]);


        $this->assertCount(
            2,
            Review::find($review->id)->comments,
            'Review reports count did not match'
        );
        $this->assertEquals(
            'great job bro',
            Review::find($review->id)->comments[0]->comment,
            'Review first comment content did not match'
        );
        $this->assertEquals(
            'keep it up',
            Review::find($review->id)->comments[1]->comment,
            'Review second comment content did not match'
        );

    }
    /** @test */
    public function should_retrieve_only_parent_comments_of_review(){

        $review = factory(Review::class)->create();

        $comment = factory(Comment::class)->create([
            'commentable_id' => $review->id,
            'commentable_type' => Review::class,
            'comment'=>'great job bro'
        ]);
        factory(Comment::class)->create([
            'commentable_id' => $review->id,
            'commentable_type' => Review::class,
            'comment' =>'keep it up'
        ]);
        factory(Comment::class)->create([
            'parent_id' =>$comment->id,
            'commentable_id' => $review->id,
            'commentable_type' => Review::class,
            'comment' =>'thanks'
        ]);


        $this->assertCount(
            2,
            Review::find($review->id)->comments,
            'Review reports count did not match'
        );
        $this->assertEquals(
            'great job bro',
            Review::find($review->id)->comments[0]->comment,
            'Review first comment content did not match'
        );
        $this->assertEquals(
            'keep it up',
            Review::find($review->id)->comments[1]->comment,
            'Review second comment content did not match'
        );

    }

    /** @test */
    public function can_retrieve_comments_count_of_review(){

        $review = factory(Review::class)->create();

        $this->assertEquals(
            0,
            Review::find($review->id)->commentsCount,
            'Total review comments count did not match'
        );

        $comment = factory(Comment::class)->create([
            'commentable_id' => $review->id,
            'commentable_type' => Review::class,
            'comment'=>'great job bro'
        ]);
        factory(Comment::class)->create([
            'commentable_id' => $review->id,
            'commentable_type' => Review::class,
            'comment' =>'keep it up'
        ]);
        factory(Comment::class)->create([
            'parent_id' =>$comment->id,
            'commentable_id' => $review->id,
            'commentable_type' => Review::class,
            'comment' =>'thanks'
        ]);
        factory(Comment::class)->create([
            'parent_id' =>$comment->id,
            'commentable_id' => $review->id,
            'commentable_type' => Review::class,
            'comment' =>'thanks'
        ]);

        $this->assertEquals(
            4,
            Review::find($review->id)->commentsCount,
            'Total review comments count did not match'
        );
    }

    /** @test */
    public function can_retrieve_language_of_review(){
        $lang = factory(Language::class)->create([
            'name' => 'english',
        ]);

        $review = factory(Review::class)->create([
            'language_id' => $lang->id
        ]);




        $this->assertEquals(
            'english',
            Review::find($review->id)->language->name,
            'Review language name did not match'
        );
    }

    /** @test */
    public function can_retrieve_reports_of_review(){
        $review = factory(Review::class)->create();

        $report1 = factory(Report::class)->create([
            'reportable_id' => $review->id,
            'reportable_type' => Review::class,
            'content'=>'contains spoilers'
        ]);
        $report2 = factory(Report::class)->create([
            'reportable_id' => $review->id,
            'reportable_type' => Review::class,
            'content' =>'it was offensive'
        ]);
        $this->assertCount(
            2,
            Review::find($review->id)->reports,
            'Review reports count did not match'
        );
        $this->assertEquals(
            'contains spoilers',
            Review::find($review->id)->reports[0]->content,
            'Review first report content did not match'
        );
        $this->assertEquals(
            'it was offensive',
            Review::find($review->id)->reports[1]->content,
            'Review second report content did not match'
        );
    }

    /** @test */
    public function review_title_will_be_trimmed(){
        factory(Review::class)->create([
            'title'=>'  great one  '
        ]);

        $this->assertEquals(
            'great one',
            Review::all()[0]->title,
            "title did not get trimmed"
        );

    }
}
