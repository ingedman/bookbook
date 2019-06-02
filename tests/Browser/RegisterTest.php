<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
//    use DatabaseMigrations;
//    use RefreshDatabase ;

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
    public function can_register_new_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertPathIs('/login')
                ->clickLink('Register')
                ->assertSee('REGISTER')
                ->type('name','Eslam')
                ->type('email','eslam@fakhry1.com')
                ->type('password','12345678')
                ->type('password_confirmation','12345678')
                ->press('@register-form-button')
                ->assertPathIs('/')
            ;
        });
    }

    /** @test-off */
    public function can_not_register_two_account_with_same_email(){
        $user = factory(\App\User::class)->create();
        $this->browse(function (Browser $browser) use($user) {
            $browser
//                ->visit('/register')
                ->logout()
                ->visit('/register')
                ->screenshot('first')
                ->assertSee('REGISTER')
                ->type('name',$user->{'name'})
                ->type('email',$user->{'email'})
                ->type('password','12345678')
                ->type('password_confirmation','12345678')
                ->press('@register-form-button')
                ->assertPathIs('/register')
                ->assertSee('The email has already been taken.')
            ;
        });
    }


}
