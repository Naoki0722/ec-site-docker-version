<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // hasMany設定
    public function images()
    {
        //第二引数がimageテーブルのリレーショナルキー(外部キー)第三引数がproductsのリレーショナルキー(ローカルキー)
        return $this->hasMany('App\Models\Image','product_id','id');
    }

    // belongsTo設定
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }


    // likesテーブルとの多対多関係を結ぶ
    public function users()
    {
        return $this->belongsToMany(
            'App\Models\User',
            'likes', // 中間テーブル名
            'product_id', // 中間テーブルにあるFK
            'user_id'   // リレーション先モデルのFK
        )->withTimestamps(); // withTimestampsメソッドで中間テーブルのタイムスタンプを更新
    }

    // cartsテーブルとの多対多関係を結ぶ
    public function users_carts()
    {
        return $this->belongsToMany(
            'App\Models\User',
            'carts', 
            'product_id',
            'user_id'  
        )->withTimestamps();
    }
}
