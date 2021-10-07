<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'category_id', 'image'];

    //OBTENER EL ID DEL USUARIO CON SESIÓN ACTIVA
    public static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            $article->user_id = Auth::id();
        });
    }

    // Relacion de uno a muchos
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // relacion de 1 a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
