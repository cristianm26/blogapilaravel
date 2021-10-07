<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['text'];
    //OBTENER EL ID DEL USUARIO CON SESIÓN ACTIVA
    public static function boot()
    {
        parent::boot();
        static::creating(function ($comment) {
            $comment->user_id = Auth::id();
        });
    }
    // relacion de 1 a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relacion de 1 a muchos inversa
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
