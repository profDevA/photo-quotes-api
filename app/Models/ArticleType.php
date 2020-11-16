<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function article()
    {
        return $this->hasMany('App\Models\Article', 'article_type', 'id');
    }

    use HasFactory;
}
