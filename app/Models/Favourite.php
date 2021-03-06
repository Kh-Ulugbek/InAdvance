<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favourite extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        "user_id" => "integer",
        "meal_id" => "integer",
    ];
}
