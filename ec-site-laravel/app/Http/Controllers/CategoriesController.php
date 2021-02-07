<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $item = DB::table('categories');
            $data = $item->get();
            $message = 'DB connected & like successfully got';
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $now = Carbon::now();
            $category = new Category;
            $category->name = $request->name;
            $category->description = $request->description;
            $category->created_at = $now;
            $category->updated_at = $now;
            $category->save();
            $message = 'DB connected & category successfully created!';
            $status = 200;
        } catch (\Throwable $th) {
            $message = 'ERROR DB connection NG ';
            $status = 500;
        } finally {
            return response()->json([
                'data' => $category,
                'message' => $message
            ], $status);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        try {
            $item = DB::table('categories')->where('id', $category->id)->get();
            $message = 'DB connected & get_data';
            $status = 200;
        } catch (\Throwable $th) {
            $message = 'ERROR DB connection NG ';
            $status = 500;
        } finally {
            return response()->json([
                'data' => $item,
                'message' => $message
            ], $status);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            Category::where('id', $category->id)->delete();
            $message = 'DB connected & category deleted!';
            $status = 200;
        } catch (\Throwable $th) {
            $message = 'ERROR DB connection NG ';
            $status = 500;
        } finally {
            return response()->json([
                'message' => $message
            ], $status);
       }
    }
}