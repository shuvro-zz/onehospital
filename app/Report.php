<?php

namespace patholab;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $timestamps = false;
    protected $visible = ['innerTests', 'user_id', 'name', 'id'];
    protected $fillable = ['innerTests', 'user_id', 'name'];
}
