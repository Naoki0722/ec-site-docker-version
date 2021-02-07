<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // carts?user_id=○でリクエストする
    public function index(Request $request)
    {
        try {
            $user = User::where('id', $request->user_id)->first();
            $products = $user->products_cart()->get();
            $data = [];
            foreach ($products as $product) {
                $data[] = [
                    'product_name' => $product->title,
                    'category_name' => $product->category->name,
                    'product_price' => $product->price,
                    'images' => $product->images
                ];
            }
            $message = 'DB connected & carts info got!';
            $status = 200;
        } catch (\Throwable $th) {
            $message = 'ERROR DB connection NG ';
            $status = 500;
        } finally {
            return response()->json([
                'data' => $data,
                'message' => $message
            ], $status);
        }

        // try {
        //     $items = Cart::where('user_id', $request->user_id)->get();
        //     $message = 'DB connected & cart_info successfully got';
        //     $status = 200;
        // } catch (\Throwable $th) {
        //     $message = 'ERROR DB connection NG ';
        //     $status = 500;
        // } finally {
        //     return response()->json([
        //         'data' => $items,
        //         'message' => $message
        //     ], $status);
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            // 多対多で簡潔に書く
            $user = User::where('id', $request->user_id)->first();
            $data = $user->cart($request->product_id); // User.phpのcartを呼び出す
            $message = 'DB connected & user insert cart!';
            $status = 200;
        } catch (\Throwable $th) {
            $message = 'ERROR DB connection NG ';
            $status = 500;
        } finally {
            return response()->json([
                'data' => $data,
                'message' => $message
            ], $status);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */

    //api/carts/カートidを入れればいい
    public function destroy(Cart $cart)
    {

        try {
            // 多対多で簡潔に書く
            $user = User::where('id', $cart->user_id)->first();
            $data = $user->delcart($cart->product_id); // User.phpのunlikeを呼び出す
            $message = 'DB connected & like destory';
            $status = 200;
        } catch (\Throwable $th) {
            $message = 'ERROR DB connection NG ';
            $status = 500;
        } finally {
            return response()->json([
                'data' => $data,
                'message' => $message
            ], $status);
        }

        
        // 従来の書き方
        // try {
        //     // Cart::where('user_id', $request->user_id)->where('product_id', $request->product_id)->delete();
        //     $item = Cart::where('user_id', $request->user_id)->where('product_id', $request->product_id)->delete();
        //     $message = 'DB connected & cart successfully deleted';
        //     $status = 200;
        // } catch (\Throwable $th) {
        //     $message = 'ERROR DB connection NG ';
        //     $status = 500;
        // } finally {
        //     return response()->json([
        //         'data' => $item,
        //         'message' => $message
        //     ], $status);
        // }
    }
}
