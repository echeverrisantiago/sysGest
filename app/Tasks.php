<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    public $timestamps = false;
    protected $table = 'tasks';
    protected $fillable = [
        'name',
        'description',
        'state',
        'user',
        'updated_at',
        'created_at'
    ];
}
