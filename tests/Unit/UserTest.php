<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLoginPage()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testDuplicateUser()
    {
        $user1 = User::make([
            'name' => 'zikri',
            'email' => 'zikri@gmail.com'
        ]);

        $user2 = User::make([
            'name' => 'ahmad',
            'email' => 'ahmad@gmail.com'
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }

    public function testRegisterPage()
    {
        $this->get('/register')->assertStatus(200);
    }

    public function testRegisterUser()
    {
        $response = $this->post('/register', [
            'name' => 'Dary',
            'email' => 'dary@gmail.com',
            'password' => 'dary1234',
            'password_confirmation' => 'dary1234'
        ]);

        $response->assertRedirect('/');
    }

    public function testDataExistOnDatabase()
    {
        $this->assertDatabaseHas('users', [
            'name' => 'Dary'
        ]);
    }

    public function testDataDoesNotExistInDatabase()
    {
        $this->assertDatabaseMissing('users', [
            'name' => 'marijuana'
        ]);
    }
}
