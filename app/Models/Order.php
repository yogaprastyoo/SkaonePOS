<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_order', 'user_id', 'grand_total',
        'payment', 'pay', 'change',
    ];

    /**
     * Children of user Relations
     */
    public function user()
    {
        return $this->belongsTo(User::class,);
    }

    /**
     * Parent of Order Product Relations
     */
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }
}
