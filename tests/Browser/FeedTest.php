<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FeedTest extends DuskTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->seed('TestingSeeder');
    }

    protected function tearDown(): void
    {
        $this->artisan('migrate:fresh');
        parent::tearDown();

    }

    /** @test */
    public function user_can_see_reviews_of_his_following_users()
    {
        $user1 = factory(\App\User::class)->create();
        $user2 = factory(\App\User::class)->create();
        $user1->followings()->attach($user2);

        factory(\App\Review::class)->create([
            "language_id" => 1,
            "title" => "The great review title",
            "reviewer_id" => $user2->{'id'}
        ]);


        $this->browse(function (Browser $browser) use ($user1) {
            $browser->loginAs($user1)
                ->visit('/')
                ->assertSee("The great review title");
        });
    }
}
