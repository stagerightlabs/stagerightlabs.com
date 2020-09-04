<?php

namespace Tests\Unit\Actions;

use App\Actions\Users\UserAccountCreationAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAccountCreationActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_users()
    {
        $action = (new UserAccountCreationAction)->execute([
            'name' => 'Grace Hopper',
            'email' => 'grace@example.com',
            'password' => 'secret',
        ]);

        $this->assertTrue($action->completed());
        $this->assertDatabaseHas('users', [
            'name' => 'Grace Hopper',
            'email' => 'grace@example.com',
        ]);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $action = (new UserAccountCreationAction)->execute([
            'email' => 'grace@example.com',
            'password' => 'secret',
        ]);

        $this->assertFalse($action->completed());
        $this->assertDatabaseMissing('users', [
            'email' => 'grace@example.com',
        ]);
    }

    /** @test */
    public function it_requires_a_email()
    {
        $action = (new UserAccountCreationAction)->execute([
            'name' => 'Grace Hopper',
            'password' => 'secret',
        ]);

        $this->assertFalse($action->completed());
        $this->assertDatabaseMissing('users', [
            'name' => 'Grace Hopper',
        ]);
    }

    /** @test */
    public function it_requires_a_password()
    {
        $action = (new UserAccountCreationAction)->execute([
            'name' => 'Grace Hopper',
            'email' => 'grace@example.com',
        ]);

        $this->assertFalse($action->completed());
        $this->assertDatabaseMissing('users', [
            'email' => 'grace@example.com',
        ]);
    }

    /** @test */
    public function it_converts_email_addresses_to_lowercase()
    {
        $action = (new UserAccountCreationAction)->execute([
            'name' => 'Grace Hopper',
            'email' => 'GRACE@EXAMPLE.COM',
            'password' => 'secret',
        ]);

        $this->assertTrue($action->completed());
        $this->assertDatabaseHas('users', [
            'name' => 'Grace Hopper',
            'email' => 'grace@example.com',
        ]);
    }
}
