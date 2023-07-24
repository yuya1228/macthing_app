<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'password'=>Hash::make('suponji'),
            'role'=>1,
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'パトリック',
            'email' => 'Patoric@gmail.com',
            'password' => Hash::make('patrick'),
            'role' => 2
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'イカルド',
            'email' => 'Ikarud@gmail.com',
            'password' => Hash::make('ikarud'),
            'role' => 3
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'name' => 'カーニーさん',
            'email' => 'Kani@gmail.com',
            'password' => Hash::make('kani'),
            'role' => 4
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'name' => 'プランクトン',
            'email' => 'Prancton@gmail.com',
            'password' => Hash::make('prancton'),
            'role' => 5
        ]);

        DB::table('users')->insert([
            'id' => 6,
            'name' => 'サンディ',
            'email' => 'Sandy@gmail.com',
            'password' => Hash::make('sandy'),
            'role' => 6
        ]);

        DB::table('users')->insert([
            'id' => 7,
            'name' => 'ゲイリー',
            'email' => 'Geily@gmail.com',
            'password' => Hash::make('geily'),
            'role' => 7
        ]);

        DB::table('users')->insert([
            'id' => 8,
            'name' => 'テストユーザー1',
            'email' => 'test1@gmail.com',
            'password' => Hash::make('test1'),
            'role' => 91
        ]);

        DB::table('users')->insert([
            'id' => 9,
            'name' => 'テストユーザー2',
            'email' => 'test2@gmail.com',
            'password' => Hash::make('test2'),
            'role' => 8
        ]);
    }
}
