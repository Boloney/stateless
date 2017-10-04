<?php

namespace App\Models;

use App\Traits\UserRules;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'user_id', 'parent_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
