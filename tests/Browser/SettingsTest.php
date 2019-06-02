<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SettingsTest extends DuskTestCase
{
    public $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->seed('TestingSeeder');
        $this->user = factory(\App\User::class)->create([
            'name' => 'Eslam Fakhry',
            'email' => 'esl@m.com',
            'bio' => 'Full-stack web developer.'
        ]);
    }

    protected function tearDown(): void
    {
        $this->artisan('migrate:fresh');
        parent::tearDown();

    }

    /** @test */
    public function can_reach_settings_page()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/')
                ->press('@navbar-profile-avatar')
                ->clickLink('Settings')
                ->assertPathIs('/settings')
                ->assertSee('Eslam Fakhry')
                ->assertSee('esl@m.com')
                ->assertSee('Full-stack web developer.');
        });
    }

    /** @test */
    public function can_change_name()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/settings')
                ->press('@setting-edit-button-name')
                ->type('name','Ahmed khaled')
                ->press('Save')
                ->waitForText('has been updated')
            ;
            $this->assertEquals(User::find($this->{'user'}->{'id'})->{'name'},'Ahmed khaled');

        });
    }

    /** @test */
    public function can_change_email()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/settings')
                ->press('@setting-edit-button-email')
                ->type('email','eslam@biz.com')
                ->press('Save')
                ->waitForText('has been updated')
            ;
            $this->assertEquals(User::find($this->{'user'}->{'id'})->{'email'},'eslam@biz.com');
        });
    }

    /** @test */
    public function can_change_bio()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit('/settings')
                ->press('@setting-edit-button-bio')
                ->type('bio','laravel developer.')
                ->press('Save')
                ->waitForText('has been updated')
            ;
            $this->assertEquals(User::find($this->{'user'}->{'id'})->{'bio'},'laravel developer.');
        });
    }



}
