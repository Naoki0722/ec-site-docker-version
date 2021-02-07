<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // カテゴリーNoに対する商品(画像も)が取れているかを確認するテスト
    public function testGetCategory()
    {
        $response = $this->getJson('/api/categories/1/products');

        $response->assertStatus(200)
                ->assertJsonFragment([
                    'category_name' => 'ピアス',
                    'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/1-1.JPG'
                ]);
    }

    // 指定した商品が確実に取得できているか確認するテスト
    public function testGetProduct()
    {
        $response = $this->getJson('/api/categories/1/products/1');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'product_name' => 'クロスシルバーピアス',
                'image_url' => 'https://tokuda-ec-site.s3-ap-northeast-1.amazonaws.com/1-1.JPG'
            ]);
    }


    // カテゴリーNoに対する間違った商品が紐づいていないかをテストする
    public function testFailedCategory()
    {
        $response = $this->getJson('/api/categories/2/products');

        $response->assertStatus(200)
                ->assertJsonMissing([
                    'category_name' => 'ピアス'
                ]);
    }

    // 指定した商品が確実に取得できているか確認するテスト
    public function testFailedProduct()
    {
        $response = $this->getJson('/api/categories/1/products/2');

        $response->assertStatus(200)
                ->assertJsonMissing([
                    'product_name' => 'クロスシルバーピアス'
                ]);
    }
    
}
