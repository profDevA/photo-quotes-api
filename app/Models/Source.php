<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Source extends Model
{
    protected $fillable = [
        'firstName','middleName','lastName', 'slug','comments','bio','urlName','visible','ipAddress','viewed_Times','sourceName','misc','metatag','quoteTitle','quoteCountVisible','viewed_times_date', 'metaTitle', 'metaDescription', 'backgroundImage'
    ];

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

    public function photos() {
        return $this->hasMany('App\Models\Photo', 'sourceId');
    }
    
    use HasFactory;
}
