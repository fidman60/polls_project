<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

    protected $fillable = [
        'answer', 'result', 'poll_id'
    ];

    public function poll(){
        return $this->belongsTo(\App\Models\Poll::class);
    }

}
