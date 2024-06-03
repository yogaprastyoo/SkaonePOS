<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'stock', 'sort',
        'unit', 'unit_price', 'cost_price',
    ];

    /*******************************/
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->sort = static::count() + 1;
        });
    }
}
