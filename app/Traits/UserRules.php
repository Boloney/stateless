<?php namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserRules
{
    public function can_edit(){
        if($this->user_id == Auth::id()){
            return true;
        }
        return false;
    }
}