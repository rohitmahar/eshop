<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
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
            'sitename' => 'Eshop',
            'phone' => '983824687324',
            'email' => 'madhusudhansubedi4@gmail.com',
            'address' => 'Sanepa 2 Lalitpur',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
