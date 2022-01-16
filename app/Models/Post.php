<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'postContent',
        'file_path',
    ];

    use HasFactory;

    /**
     * Creates relationship to the Model User - one to many.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    /**
     * Creates relationship to Model Comment - many to one.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
