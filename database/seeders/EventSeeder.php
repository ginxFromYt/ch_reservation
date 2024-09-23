<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'name' => 'Sunday Mass',
                'description' => 'A weekly mass service for all parishioners.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wedding Ceremony',
                'description' => 'A holy matrimony service for couples.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Baptism',
                'description' => 'A baptism ceremony for infants and adults.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Christmas Eve Mass',
                'description' => 'A special mass service held on the eve of Christmas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Burial Mass',
                'description' => 'A mass service held in remembrance of a deceased loved one.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
