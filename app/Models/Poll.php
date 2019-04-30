<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model {

    protected $fillable = [
        'question'
    ];

    public function answers(){
        return $this->hasMany(\App\Models\Answer::class);
    }

    public function users(){
        return $this->belongsToMany(\App\Models\User::class);
    }

}
