<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $attributes;

    public function setUp(): void
    {
        parent::setUp();

        $this->attributes = [
            'name'     => 'テスト太郎',
            'mail'     => 'hoge@example.com',
            'password' => 'pass',
        ];
    }

    public function test_can_register()
    {
        User::create($this->attributes);
        $this->assertDatabaseHas('users', $this->attributes);
    }
}
