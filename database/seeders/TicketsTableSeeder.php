<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        App\Ticket::create([
            'title' => 'first ticket',
            'description' => 'this is first ticket',
            'ticket_id' => 'FDS34345',
            'priority' => 'low',
            'type' => 'cleaning',
            'user_id' => 1
        ]);

        App\Ticket::create([
            'title' => 'second ticket',
            'description' => 'this is second ticket',
            'ticket_id' => 'FDS343EE45',
            'priority' => 'high',
            'type' => 'all',
            'user_id' => 1
        ]);
        
    }
}
