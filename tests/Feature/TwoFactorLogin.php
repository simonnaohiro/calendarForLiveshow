<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TwoFactorLogin extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get(route('login_form'));

        $response->assertStatus(200)
        ->assertViewIs('two_factor_auth.login_form')
        ->assertSee('ログイン')
        ->assertSee('パスワード');
    }
}
