<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


use Illuminate\Database\Seeder;

class FakerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('categories')->insert([
            [
                'name' => 'ピアス',
                'description' => 'あくまでテストです',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'リング',
                'description' => 'あくまでテストです',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '指輪',
                'description' => 'これはあくまでテストですので関係ないです',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '修理',
                'description' => 'これはあくまでテストですので関係ないです',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
