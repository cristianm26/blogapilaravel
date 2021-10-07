<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    // Relacion de muchos a muchos inversa
    public function users()
    {
        return $this->belongsToMany(User::class)->as('subscriptions')->withTimestamps();
    }
}
