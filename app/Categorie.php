<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ["name", "slug"];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

}
