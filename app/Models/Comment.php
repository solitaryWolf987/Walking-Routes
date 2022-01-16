<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Creates relationship to the Model User - one to many.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Creates relationship to the Model Post - one to many.
     */
    public function posts()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
