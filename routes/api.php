<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Models\Article;
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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'authenticate']);
Route::get('articles', [ArticleController::class, 'index']);


Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('user', [UserController::class, 'getAuthenticatedUser']);
    //Articulos

    Route::get('articles/{id}', [ArticleController::class, 'show']);
    Route::post('articles', [ArticleController::class, 'store']);
    Route::put('articles/{id}',  [ArticleController::class, 'update']);
    Route::delete('articles/{id}', [ArticleController::class, 'delete']);
    Route::get('articles/{article}/image', [ArticleController::class, 'image']);
    //Comentarios
    // Comments
    Route::get('articles/{article}/comments', [CommentController::class, 'index']);
    Route::get('articles/{article}/comments/{comment}', [CommentController::class, 'show']);
    Route::post('articles/{article}/comments', [CommentController::class, 'store']);
    Route::put('articles/{article}/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('articles/{article}/comments/{comment}', [CommentController::class, 'delete']);
});

// Obtener el articulo por el id

// Obtener todo el articulo por el cuerpo del articulo
/* Route::get('articles/{article}', 'ArticleController@show'); */



// Actualizar el articulo por el id

// Actualizar todo el articulo por el cuerpo del articulo
/* Route::get('articles/{article}', [ArticleController::class, 'update']); */

// Eliminar el articulo por el id

// Eliminar todo el articulo por el cuerpo del articulo
/* Route::get('articles/{article}', [ArticleController::class, 'delete']); */
