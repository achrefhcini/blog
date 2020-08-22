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
        'titre', 'image' ,'category_id', 'text',
    ];

    /**
     * Relationship between a post with a category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }

    protected static $imageFields = [
        'image'
    ];



}
