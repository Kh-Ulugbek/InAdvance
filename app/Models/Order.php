<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $casts = [
        "user_id" => "integer",
        "restaurant_id" => "integer",
        "table_id" => "integer",
    ];

    public function restaurant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id', 'id');
    }

    public function table(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Table::class, 'table_id', 'id');
    }

    public function meals(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Meal::class, 'meal_orders', 'order_id', 'meal_id');
    }
}
