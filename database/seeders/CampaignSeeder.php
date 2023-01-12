<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns')->insert([
            'title' => 'Test Comapign 2',
        ]);

        DB::table('campaigns')->insert([
            'title' => 'Test Comapign 1',
        ]);
    }
}
