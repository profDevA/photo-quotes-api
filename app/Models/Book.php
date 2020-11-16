<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'pubDate','isbn','amazonUrl','visible','visibleComments','hiddenComments','author','source_id','bookImage','bookStoreName','category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function source()
    {
        return $this->belongsTo('App\Models\Source');
    }
}
