<?php

use App\Http\Controllers\ArticleController;
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

Route::get('articles', [ArticleController::class, 'index']);

// Obtener el articulo por el id
Route::get('articles/{id}', [ArticleController::class, 'show']);
// Obtener todo el articulo por el cuerpo del articulo
/* Route::get('articles/{article}', 'ArticleController@show'); */


Route::post('articles', [ArticleController::class, 'store']);

// Actualizar el articulo por el id
Route::put('articles/{id}',  [ArticleController::class, 'update']);
// Actualizar todo el articulo por el cuerpo del articulo
/* Route::get('articles/{article}', [ArticleController::class, 'update']); */

// Eliminar el articulo por el id
Route::delete('articles/{id}', [ArticleController::class, 'delete']); 
// Eliminar todo el articulo por el cuerpo del articulo
/* Route::get('articles/{article}', [ArticleController::class, 'delete']); */
