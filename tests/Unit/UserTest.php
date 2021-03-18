<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;

class UserTest extends TestCase
{
    public function testDatabase()
    {
        // アプリケーションを呼び出す…

        $this->assertDatabaseHas('users', [
            'email' => 'naoto93@example.net',
        ]);
    }
}
