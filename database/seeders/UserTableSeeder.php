<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id'=>1,
            'name'=>'スポンジ・ボブ',
            'email'=>'Suponji@gmail.com',
            'password'=>'suponji',
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'パトリック',
            'email' => 'Patoric@gmail.com',
            'password' => 'patrick',
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'イカルド',
            'email' => 'Ikarud@gmail.com',
            'password' => 'ikarud',
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'name' => 'カーニーさん',
            'email' => 'Kani@gmail.com',
            'password' => 'Kani',
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'name' => 'プランクトン',
            'email' => 'Prancton@gmail.com',
            'password' => 'prancton',
        ]);

        DB::table('users')->insert([
            'id' => 6,
            'name' => 'サンディ',
            'email' => 'Sandy@gmail.com',
            'password' => 'sandy',
        ]);

        DB::table('users')->insert([
            'id' => 7,
            'name' => 'ゲイリー',
            'email' => 'Geily@gmail.com',
            'password' => 'geily
            ',
        ]);
    }
}
