<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TopPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $year = 2021;
        $month = 1;
        while($month < 12){
            $response = $this->get(route('calendar', ['year' => $year, 'month' => $month]));

            if($i = 1){
                $prev = 12;
                $next = $i + 1;
            }elseif($i = 12){
                $prev = $i - 1;
                $next = 1;
            }else{
                $prev = $i - 1;
                $next = $i + 1;
            }

            $response->assertStatus(200)
            ->assertViewIs('calendar')
            ->assertSee($month.'月')
            ->assertSee('/'.$prev)->assertSee('/'.$next);

            $month++;
        }
    }
}
