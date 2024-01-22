<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public function follows()
    {
        return $this->belongsToMany('App\Models\User','follows','user_id','followed_user_id');
    }
}
