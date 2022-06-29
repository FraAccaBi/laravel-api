<?php

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::get('posts', function(){
    $posts = Post::all();
    return response()->json([
        'status_code' => 200,
        'post' => $posts
    ]);
}); */

Route::get('posts', function(){
    $posts = Post::with(['tags', 'category'])->paginate(9);
    return $posts;
});
