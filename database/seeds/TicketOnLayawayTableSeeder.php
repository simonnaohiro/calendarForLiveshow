<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TicketOnLayawayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_on_layaways')->insert([
            'event_id' => '28',
            'user_id' => 277,
            'performer_name' => 'bandE',
        ]);
    }
}
