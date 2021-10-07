<?php

namespace App\Http\Controllers;

use App\Http\Resources\Article as ResourcesArticle;
use App\Http\Resources\Comment as ResourcesComment;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article)
    {
        //
        return response()->json(ResourcesComment::collection($article->comments->sortByDesc('created_at')), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article, Comment $comment)
    {
        //
        $comment = $article->comments()->where('id', $comment->id)->firstOrFail();
        return response()->json(new ResourcesComment($comment), 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
        //
        $request->validate([
            'text' => 'required|string'
        ]);

        $comment = $article->comments()->save(new Comment($request->all()));
        return response()->json($comment, 201);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function delete(Comment $comment)
    {
        //
    }
}
