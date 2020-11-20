<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'text', 'author', 'visible', 'visible_comments', 'hidden_comments', 'source_id', 'category_id', 'article_type', 'url', 'featured_image', 'meta_title', 'meta_description'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function source()
    {
        return $this->belongsTo('App\Models\Source');
    }

    public function articletype()
    {
        return $this->belongsTo('App\Models\ArticleType', 'article_type', 'id');
    }

    public function setSlugAttribute($value) {

        if (static::whereSlug($slug = Str::slug($value))->exists()) {
    
            $slug = $this->incrementSlug($slug);
        }
    
        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug($slug) {

        $original = $slug;
    
        $count = 2;
    
        while (static::whereSlug($slug)->exists()) {
    
            $slug = "{$original}-" . $count++;
        }
    
        return $slug;
    
    }
}
