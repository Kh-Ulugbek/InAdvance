<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'created_by',
        'title_en',
        'title_ua',
        'description_ua',
        'description_en',
        'text_ua',
        'text_en',
        'image',
        'start_date',
        'end_date'
    ];
}
