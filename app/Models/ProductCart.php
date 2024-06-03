<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id', 'user_id',
        'qty', 'total',
    ];

    /**
     * Children of Product Relations
     */
    public function product()
    {
        return $this->belongsTo(Product::class,);
    }
}
