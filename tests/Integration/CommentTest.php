<?php

namespace Tests\Integration\Database;

use App\Comment;
use App\Language;
use App\Reaction;
use App\Report;
use App\Review;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Integration\DatabaseTest;

class CommentTest extends DatabaseTest
{
    /** @test */
    public function can_retrieve_review_commented_on()
    {

        $review = factory(Review::class)->create([
            'title' => 'what is that with War and Peace'
        ]);
        $comment = factory(Comment::class)->create([
            'commentable_type' => Review::class,
            'commentable_id' => $review->id,
        ]);

        $this->assertInstanceOf(
            Review::class,
            Comment::all()[0]->commentable,
            'commentable did not return a Review'
        );

        $this->assertEquals(
            'what is that with War and Peace',
            Comment::all()[0]->commentable->title,
            'returned review title did not match'
        );
    }

    /** @test */
    public function can_retrieve_parent_comment()
    {


        $comment1 = factory(Comment::class)->create([
            'comment' => 'great job'
        ]);
        $comment2 = factory(Comment::class)->create([
            'comment' => 'thank you',
            'parent_id' => $comment1->id
        ]);


        $this->assertInstanceOf(
            Comment::class,
            Comment::find($comment2->id)->parent,
            'parent did not return a Comment'
        );

        $this->assertEquals(
            'great job',
            Comment::find($comment2->id)->parent->comment,
            'returned comment content did not match'
        );
    }

    /** @test */
    public function can_retrieve_comment_replies()
    {


        $comment1 = factory(Comment::class)->create([
            'comment' => 'great job'
        ]);
        $comment2 = factory(Comment::class)->create([
            'comment' => 'thank you',
            'parent_id' => $comment1->id
        ]);
        $comment3 = factory(Comment::class)->create([
            'comment' => 'totally agree with you',
            'parent_id' => $comment1->id
        ]);


        $this->assertInstanceOf(
            Comment::class,
            Comment::find($comment1->id)->replies[0],
            'first reply is not a Comment'
        );

        $this->assertEquals(
            'thank you',
            Comment::find($comment1->id)->replies[0]->comment,
            'first reply content did not match'
        );

        $this->assertEquals(
            'totally agree with you',
            Comment::find($comment1->id)->replies[1]->comment,
            'second reply content did not match'
        );
    }

    /** @test */
    public function can_retrieve_replies_count_of_comment(){

        $comment = factory(Comment::class)->create();

        factory(Comment::class)->create([
            'parent_id' =>$comment->id,
        ]);
        factory(Comment::class)->create([
            'parent_id' =>$comment->id,
        ]);

        $this->assertEquals(
            2,
            Comment::find($comment->id)->repliesCount,
            'Total comment replies count did not match'
        );
    }


    /** @test */
    public function can_retrieve_reports_of_book()
    {
        $comment = factory(Comment::class)->create();

        factory(Report::class)->create([
            'reportable_id' => $comment->id,
            'reportable_type' => Comment::class,
            'content' => 'it is offensive'
        ]);
        factory(Report::class)->create([
            'reportable_id' => $comment->id,
            'reportable_type' => Comment::class,
            'content' => 'contains a spoiler'
        ]);
        $this->assertCount(
            2,
            Comment::find($comment->id)->reports,
            'Comment reports count did not match'
        );
        $this->assertEquals(
            'it is offensive',
            Comment::find($comment->id)->reports[0]->content,
            'Comment first report content did not match'
        );
        $this->assertEquals(
            'contains a spoiler',
            Comment::find($comment->id)->reports[1]->content,
            'Comment second report content did not match'
        );
    }

    /** @test */
    public function can_retrieve_commenter()
    {
        $user = factory(User::class)->create(['name' => 'Eslam Fakhry']);
        $comment = factory(Comment::class)->create([
            'user_id' => $user->id,
        ]);
        $this->assertEquals('Eslam Fakhry',
            Comment::find($comment->id)->commenter->name,
            'commenter name did not match'
        );

    }

    /** @test */
    public function can_retrieve_likes()
    {
        $comment = factory(Comment::class)->create([
        ]);

        factory(Reaction::class)->create([
            'reactionable_type'=>Comment::class,
            'reactionable_id'=>$comment->id,
            'is_like'=>true


        ]);
        factory(Reaction::class)->create([
            'reactionable_type'=>Comment::class,
            'reactionable_id'=>$comment->id,
            'is_like'=>true


        ]);
        factory(Reaction::class)->create([
            'reactionable_type'=>Comment::class,
            'reactionable_id'=>$comment->id,
            'is_like'=>false


        ]);
        $this->assertCount(2,
            Comment::find($comment->id)->likes,
            'likes count did not match'
        );

    }
    /** @test */
    public function can_retrieve_dislikes()
    {
        $comment = factory(Comment::class)->create([
        ]);

        factory(Reaction::class)->create([
            'reactionable_type'=>Comment::class,
            'reactionable_id'=>$comment->id,
            'is_like'=>true


        ]);
        factory(Reaction::class)->create([
            'reactionable_type'=>Comment::class,
            'reactionable_id'=>$comment->id,
            'is_like'=>false


        ]);
        factory(Reaction::class)->create([
            'reactionable_type'=>Comment::class,
            'reactionable_id'=>$comment->id,
            'is_like'=>false


        ]);
        $this->assertCount(2,
            Comment::find($comment->id)->dislikes,
            'likes count did not match'
        );

    }


}

