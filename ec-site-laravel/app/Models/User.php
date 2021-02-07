<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // likesテーブルとの多対多関係を結ぶ
    public function products()
    {
        return $this->belongsToMany(
            'App\Models\Product', 
            'likes', // 中間テーブル名
            'user_id', // 中間テーブルにあるFK
            'product_id'   // リレーション先モデルのFK
        )->withPivot('id')
        ->withTimestamps(); // withTimestampsメソッドで中間テーブルのタイムスタンプを更新
    }


    // likesテーブルとの多対多関係を結ぶ
    public function products_cart()
    {
        return $this->belongsToMany(
            'App\Models\Product',
            'carts', 
            'user_id',
            'product_id'
        )->withTimestamps();
    }



    // 以降いいねをつけた場合に使う関数として登録しておく。
    public function is_like($productId)
    {
        return $this->products()->where('product_id', $productId)->exists();
    }


    public function like($productId)
    {
        $exist = $this->is_like($productId);

        if($exist) {
            return false;
            // deleteメソッドに飛ばすことも可能
            // return $this->unlike($productId);
        } else {
            $this->products()->attach($productId);
            return true;
        }
    }

    public function unlike($productId)
    {
        $exist = $this->is_like($productId);

        if($exist) {
            $this->products()->detach($productId);
            return true;
        } else {
            return false;
        }
    }

    // 以降cartにいれた場合に使う関数として登録しておく。
    public function is_cart($productId)
    {
        return $this->products_cart()->where('product_id', $productId)->exists();
    }


    public function cart($productId)
    {
        $exist = $this->is_cart($productId);

        if($exist) {
            return false;
        } else {
            $this->products_cart()->attach($productId);
            return true;
        }
    }

    public function delcart($productId)
    {
        $exist = $this->is_cart($productId);

        if($exist) {
            $this->products_cart()->detach($productId);
            return true;
        } else {
            return false;
        }
    }


}
