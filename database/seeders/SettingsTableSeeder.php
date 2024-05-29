<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();

        DB::table('settings')->insert([
            'key' => 'site_title',
            'value' => 'Rubycon',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('settings')->insert([
            'key' => 'site_logo',
            'value' => '',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('settings')->insert([
            'key' => 'reserved_right',
            'value' => '@ 2023 All rights resevered',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('settings')->insert([
            'key' => 'show_item_per_page',
            'value' => '10',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
