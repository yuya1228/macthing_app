<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genders')->insert([
            'id' => 1,
            'gender'=> '男性'
        ]);

        DB::table('genders')->insert([
            'id'=> 2,
            'gender' => '女性'
        ]);
    }
}
