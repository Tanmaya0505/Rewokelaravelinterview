<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['user_id','name','email','comment'];

    public function user_data()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
