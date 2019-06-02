<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /** @test */
    public function user_can_not_log_in(){
        $user = factory(\App\User::class)->create();
        $this->browse(function (Browser $browser) use($user) {
            $browser
                ->visit('/login')
//                ->screenshot('first')
                ->assertSee('LOGIN')
                ->type('email',$user->{'email'})
                ->type('password','password')
                ->press('@login-form-button')
                ->assertPathIs('/')
            ;
        });
    }
}
