<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'price', 'description', 'product_category_id', 'is_available', 'image', 'slug', 'sort'
    ];

    /**
     * Children of Product Category Relations
     */
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class,);
    }

    /**
     * Parent of Order Products Relations
     */
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'product_id', 'id');
    }

    /*******************************/
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
            $model->sort = static::count() + 1;
        });
    }
}
