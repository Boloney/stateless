<?php

namespace App\Models;

use App\Traits\UserRules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $photoPath = 'upload/products/';
    protected $fillable = ['name', 'description', 'photo', 'photo_description', 'user_id', 'category_id'];
    protected $appends = ['short_description'];

    public function getShortDescriptionAttribute()
    {
        return mb_substr($this->description, 0, 10);
    }

    public function getPhoto()
    {
        $path = public_path($this->photoPath . '/' . $this->photo);
        if($this->photo && file_exists($path)){
            return url($this->photoPath . $this->photo);
        }
        return null;
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'product_tags')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
