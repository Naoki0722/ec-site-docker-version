<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1つのカテゴリーに複数商品、商品に複数画像のダミーデータを生成する方法を勉強できた
        // Product::factory()
        //     ->has(Image::factory()->count(3))
        //     ->create();
    



        // $this->call([CategoriesTableSeeder::class],[ProductsTableSeeder::class], [ImagesTableSeeder::class], [LikeTableSeeder::class]);

        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(LikeTableSeeder::class);
    }
}
