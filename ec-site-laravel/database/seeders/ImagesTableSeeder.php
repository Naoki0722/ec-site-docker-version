<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('images')->insert([
            [
                'product_id' => 1,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/8-1.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 1,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/8-2.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 1,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/8-3.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 2,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/7-1.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 2,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/7-2.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 2,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/7-3.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 3,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/6-1.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 3,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/6-2.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 3,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/5-1.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 3,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/5-2.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
