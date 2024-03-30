<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->truncate();

        DB::table('pages')->insert([
            'title' => 'Home',
            'slug' => Str::slug('Home'),
            'status' => 'Active',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pages')->insert([
            'title' => 'Products',
            'slug' => Str::slug('Products'),
            'status' => 'Active',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pages')->insert([
            'title' => 'Profile',
            'slug' => Str::slug('Profile'),
            'status' => 'Active',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pages')->insert([
            'title' => 'Facilities',
            'slug' => Str::slug('Facilities'),
            'status' => 'Active',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pages')->insert([
            'title' => 'OEMs',
            'slug' => Str::slug('OEMs'),
            'status' => 'Active',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pages')->insert([
            'title' => 'Contact',
            'slug' =>  Str::slug('Contact'),
            'status' => 'Active',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pages')->insert([
            'title' => 'Automation',
            'slug' =>  Str::slug('Automation'),
            'status' => 'Active',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
