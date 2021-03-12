<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $attributes;

    public function setUp()
    {
        parent::setUp();

        $this->attributes = [
            'name'     => 'テスト太郎',
            'mail'     => 'hoge@example.com',
            'password' => bcrypt('test'),
        ];
    }

    public function testRegister()
    {
        User::create($this->attributes);
        $this->assertDatabaseHas('users', $this->attributes);
    }
}
