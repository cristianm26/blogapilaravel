<?php

namespace App\Http\Controllers;

use App\Http\Resources\Article as ResourcesArticle;
use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    //
    public function index()
    {
        //return response()->json(ResourcesArticle::collection(Article::all(), 200));
        return new ArticleCollection(Article::paginate(5));
        //return response()->json(new ArticleCollection(Article::all(), 200));
        // return Article::all();
    }

    // Funcion para obtener el articulo por el id
    public function show($id)
    {
        $article = Article::find($id);
        return response()->json(new ResourcesArticle($article, 201));
        // return response()->json($article, 201);
    }

    // Funcion para obtener el articulo por el cuerpo del articulo
    /*  public function show(Article $article)
    {
        return $article;
    } */


    public function store(Request $request)
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'same' => 'Los campos :attribute y :other deben coincidir.',
            'size' => 'El campo :attribute debe tener exactamente :size.',
            'between' => 'El valor del campo :attribute :input no está entre :min -
           :max.',
            'unique' =>  'El campo :attribute ya existe',
            'in' => 'El campo :attribute debe estar entre las siguientes 
           opciones: :values',
        ];
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|unique:articles|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ], $messages);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'La validación de los datos fallo',
                "error_list" => $validator->errors()
            ], 400);
        }
        $article = Article::create($request->all());
        //OBTENER EL ID DEL USUARIO CON SESIÓN ACTIVA
        /*   $article = new Article($request->all());
        $article->user_id = Auth::id();
        $article->save();
        return response()->json(new ArticleResource($article), 201); */
        return response()->json(new ResourcesArticle($article, 201));
    }
    // Funcion para actualizar el articulo por el id
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'same' => 'Los campos :attribute y :other deben coincidir.',
            'size' => 'El campo :attribute debe tener exactamente :size.',
            'between' => 'El valor del campo :attribute :input no está entre :min -
           :max.',
            'unique' =>  'El campo :attribute ya existe',
            'in' => 'El campo :attribute debe estar entre las siguientes 
           opciones: :values',
        ];
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|unique:articles,title,' . $id . '|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ], $messages);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'La validación de los datos fallo',
                "error_list" => $validator->errors()
            ], 400);
        }
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return response()->json($article, 200);
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
