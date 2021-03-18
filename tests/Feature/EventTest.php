<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $year = 2020;
        $month = 2;
        $day = 1;

        $response = $this->get(route('event_list', ['year' => $year, 'month' => $month, 'day' => $day]));

        $response->assertStatus(500);
        // $response->assertViewIs('events.event_list');
    }
}
