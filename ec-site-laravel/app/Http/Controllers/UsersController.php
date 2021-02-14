<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $items = User::all();
            $message = 'DB connected & account_info successfully got';
            $status = 200;
        } catch (\Throwable $th) {
            $message = 'ERROR DB connection NG ';
            $status = 500;
        } finally {
            return response()->json([
                'data' => $items,
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
            $item = new User;
            $item->name = $request->name;
            $item->email = $request->email;
            $item->tell_number = $request->tell_number;
            $item->password = Hash::make($request->password);
            $item->created_at = $now;
            $item->updated_at = $now;
            $item->save();
            $message = 'DB connected & account successfully created';
            $status = 200;
        } catch (\Throwable $th) {
            $message = 'ERROR DB connection NG ';
            $status = 500;
        } finally {
            return response()->json([
                'data' => $item,
                'message' => $message
            ], $status); 
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try {
            $user = User::where('id', $user->id)->first();
            $message = 'DB connected & user successfully got!';
            $status = 200;
        } catch (\Throwable $th) {
            $message = 'ERROR DB connection NG ';
            $status = 500;
        } finally {
            return response()->json([
                'data' => $user,
                'massage' => $message
            ], $status);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            $now = Carbon::now();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->tell_number = $request->tell_number;
            // $user->password = Hash::make($request->password);
            $user->updated_at = $now;
            $user->save();
            $message = 'DB connected & account successfully created';
            $status = 200;
        } catch (\Throwable $th) {
            $message = 'ERROR DB connection NG ';
            $status = 500;
        } finally {
            return response()->json([
                'data' => $user,
                'massage' => $message
            ], $status);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user = User::where('id', $user->id)->delete();
            $message = 'DB connected & user successfully delete';
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
