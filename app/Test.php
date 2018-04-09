<?php

namespace patholab;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'created_at', 'type', 'result', 'comments', 'user_id'];
    
}
