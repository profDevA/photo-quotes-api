<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = [
        'firstName','middleName','lastName','comments','bio','urlName','visible','ipAddress','viewed_Times','sourceName','misc','metatag','quoteTitle','quoteCountVisible','viewed_times_date'
    ];

    use HasFactory;
}
