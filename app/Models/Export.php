<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    use HasFactory;

    /**
     * Children of user Relations
     */
    public function user()
    {
        return $this->belongsTo(User::class,);
    }
}
