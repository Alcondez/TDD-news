<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SendConfirmationEmailTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test if an confirmation email is sent when a user is registered
     *
     * @return void
     */
    public function testAConfirmationEmailIsSentUponRegistration()
    {
        $this->visit('/register')
            ->type('ExampleUser', 'name')
            ->type('Example@gmail.com', 'email')
            ->press('Register')
            ->seeInDatabase('users', ['email' => 'Example@gmail.com'])
            ->seePageIs('/login')
            ->see('We sent you an activation code. Check your email.');
    }
}
