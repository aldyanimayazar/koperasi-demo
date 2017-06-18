<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
    	'id', 
    	'name'
    ];

    protected $hidden = [
	    'created_at', 
	    'updated_at'
    ];
}
