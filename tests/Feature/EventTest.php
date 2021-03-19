<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Event;

class EventTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->event = factory(Event::class)->create([
            'post_user_id' => 2,
            'event_date' => '2021-03-19 00:00:00',
            'event_title' => 'テスト',
            'price' => '1511151',
            'contents' => 'test',
            'performer' => 'test',
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $year = 2021;
        $month = 3;
        $day = 19;

        $response = $this->get(route('event_list', ['year' => $year, 'month' => $month, 'day' => $day]));
        dd($response);
        // $response->assertStatus(200);

        // $response->assertViewIs('events.event_list');
    }
}
