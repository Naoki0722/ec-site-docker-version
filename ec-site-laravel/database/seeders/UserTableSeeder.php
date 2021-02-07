<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('users')->insert([
            [
                'name' => 'なおき',
                'email' => 'test@test.com',
                'tell_number' => '00012340000',
                'password' => '01380722',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'えりこ',
                'email' => 'test1@test.com',
                'tell_number' => '0133339455',
                'password' => '01380722',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'とくだ',
                'email' => 'test2@test.com',
                'tell_number' => '0001122340000',
                'password' => '010000',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
