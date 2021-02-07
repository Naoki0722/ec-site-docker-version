<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //hasMany設定
    public function products()
    {
        //第二引数がproductsテーブルのリレーショナルキー(外部キー)第三引数がcategoriesのリレーショナルキー(ローカルキー)
        return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }

    public function images()
    {
        // hasManyとbelongsToで繋げば実質不要である(Categoryから直でImageにアクセスする場合のみ)
        // return $this->hasManyThrough(Image::class, Product::class);
    }
}
