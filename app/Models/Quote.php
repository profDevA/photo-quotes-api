<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote', 'visibleComments','hiddenComments','visible','dataAdded','referenceId1','referenceId2','referenceId3','referenceId4','quoteOfTheDay','bookId','senderEmail', 'senderName', 'sourceId', 'sourceName', 'IPAddress', 'addedByUser', 'originalQuote', 'quoteType', 'new', 'turnVisible', 'page', 'quoteCountVisible', 'newDate', 'rssFeedType', 'adminRssFeedType', 'isEdited', 'rating', 'isEnglish', 
    ];

    public function source()
    {
        return $this->belongsTo('App\Models\Source', 'sourceId', 'id');
    }

    public function book()
    {
        return $this->belongsTo('App\Models\Book', 'bookId', 'id');
    }

    public function tagquote()
    {
        return $this->hasMany('App\Models\TagQuote', 'quoteId', 'id');
    }
}
