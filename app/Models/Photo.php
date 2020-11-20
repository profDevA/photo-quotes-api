<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['sourceId', 'title', 'description', 'addedByUser', 'url', 'comments', 'visible'];

    public function source() {
        return $this->belongsTo('App\Models\Source', 'sourceId', 'id');
    }
}
