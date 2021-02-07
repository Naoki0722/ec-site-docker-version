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
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/1-1.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 1,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/1-2.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 1,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/1-3.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 2,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/2-1.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 2,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/2-2.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 2,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/2-3.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 3,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/3-1.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 3,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/3-2.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 3,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/3-3.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'product_id' => 3,
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/3-4.JPG',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
