<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gamers')->insert([
            'id'=>1,
            'nickname'=>'LZ'
        ]);
    }
}
