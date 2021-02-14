<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // ユーザーに紐づくお気に入り一覧を表示する(すっきり)
    // api/likes?user_id=○でリクエスト
    public function index(Request $request)
    {
        try {
            $user = User::where('id', $request->user_id)->first();
            $products = $user->products()->get();
            $data = [];
            foreach ($products as $product) {
                $data[] = [
                    'like_id' => $product->pivot->id,
                    'product_id' => $product->id,
                    'product_name' => $product->title,
                    'category_name' => $product->category->name,
                    'product_price' => $product->price,
                    'images' => $product->images()->select('product_id','image_url')->get()->toArray()
                ];
            }
            $message = 'DB connected & like_info successfully got';
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


        // 旧コード
        // try {
        //     $items = DB::table('likes')
        //                 ->select('user_id', 'category_name', 'title', 'price')
        //                 ->Join(DB::raw('(select products.id as id, categories.name as category_name, title, products.description, price from products join categories on categories.id=products.category_id) as products'), 'likes.product_id', '=', 'products.id')
        //                 ->where('user_id', $request->user_id)
        //                 ->get();
        //     $message = 'DB connected & like_info successfully got';
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
            $data = $user->like($request->product_id); // User.phpのlikeを呼び出す
            $message = 'DB connected & user is liked';
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
        // $now = Carbon::now();
        // $like = Like::where('user_id', $request->user_id)->where('product_id', $request->product_id)->first();
        // if (empty($like)) {            
        //     $item = new Like;
        //     $item->user_id = $request->user_id;
        //     $item->product_id = $request->product_id;
        //     $item->created_at = $now;
        //     $item->updated_at = $now;
        //     $item->save();
        //     return response()->json([
        //         'data' => $item,
        //         'message' => 'user is liked'
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'message' => 'warning! like is exists!'
        //     ]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        // こっちは使わない
        // try {
        //     // $item = Like::where('user_id', $like->user_id)->where('product_id', $like->product_id)->delete();
        //     $item = Like::where('id', $like->id)->delete();
        //     $message = 'DB connected & likes successfully deleted';
        //     $status = 200;
        // } catch (\Throwable $th) {
        //     $message = 'ERROR DB connection NG ';
        //     $status = 500;
        // } finally {
        //     return response()->json([
        //         'message' => $message
        //     ], $status);
        // }

        
        try {
            $user = User::where('id', $like->user_id)->first();
            $data = $user->unlike($like->product_id); // User.phpのunlikeを呼び出す
            $message = 'DB connected & like successfully destory';
            $status = 200;
        } catch (\Throwable $th) {
            $message = 'ERROR DB connection NG ';
            $status = 500;
        } finally {
            return response()->json([
                'data' => $data, // true or false判定
                'message' => $message
            ], $status);
        }
    }

    public function delete(Request $request)
    {
        // こっちは使わない
        // try {
        //     // $item = Like::where('user_id', $like->user_id)->where('product_id', $like->product_id)->delete();
        //     $item = Like::where('id', $like->id)->delete();
        //     $message = 'DB connected & likes successfully deleted';
        //     $status = 200;
        // } catch (\Throwable $th) {
        //     $message = 'ERROR DB connection NG ';
        //     $status = 500;
        // } finally {
        //     return response()->json([
        //         'message' => $message
        //     ], $status);
        // }

        
        try {
            $user = User::where('id', $request->user_id)->first();
            $data = $user->unlike($request->product_id); // User.phpのunlikeを呼び出す
            $message = 'DB connected & like successfully destory';
            $status = 200;
        } catch (\Throwable $th) {
            $message = 'ERROR DB connection NG ';
            $status = 500;
        } finally {
            return response()->json([
                'data' => $data, // true or false判定
                'message' => $message
            ], $status);
        }
    }

}
