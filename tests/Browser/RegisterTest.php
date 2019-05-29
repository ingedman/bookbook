<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
//    use DatabaseMigrations;
    /** @test-off */
    public function can_register_new_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Register')
                ->assertSee('REGISTER')
                ->type('name','Eslam')
                ->type('email','eslam@yahoo1.com')
                ->type('password','12345678')
                ->type('password_confirmation','12345678')
                ->press('Register')
                ->assertPathIs('/home')
            ;
        });
    }
}
