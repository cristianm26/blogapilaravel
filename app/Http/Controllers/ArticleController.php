<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function index()
    {
        return Article::all();
    }

    // Funcion para obtener el articulo por el id
    public function show($id)
    {
        $article = Article::find($id);
        return response()->json($article, 201);
    }

    // Funcion para obtener el articulo por el cuerpo del articulo
    /*  public function show(Article $article)
    {
        return $article;
    } */


    public function store(Request $request)
    {
        $article = Article::create($request->all());
        return response()->json($article, 201);
    }
    // Funcion para actualizar el articulo por el id
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return $article;
    }

    // Funcion para actualizar el articulo por el cuerpo del articulo
    /*  public function update(Request $request, Article $article)
    {
        $article->update($request->all());
        return response()->json($article, 200);
    } */

    // Funcion para eliminar el articulo por el id
    public function delete($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return 204;
    }
    // Funcion para eliminar el articulo por el cuerpo del articulo
    /* public function delete(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    } */
}
