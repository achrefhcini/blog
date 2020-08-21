<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use QCod\ImageUp\HasImageUploads;

class Article extends Model
{
    use HasImageUploads;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre', 'image', 'text',
    ];

    protected static $imageFields = [
        'image'
    ];


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'article_id';
}
