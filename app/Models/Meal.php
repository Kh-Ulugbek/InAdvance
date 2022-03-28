<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $hidden = ['deleted_at', 'updated_at'];
    protected $casts = [
        "user_id" => "integer",
        "restaurant_id" => "integer",
        "category_id" => "integer",
    ];
}
