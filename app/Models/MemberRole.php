<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberRole extends Model
{
    protected $table = 'member_roles';

    protected $fillable = [
    	'id', 
    	'name'
    ];

    protected $hidden = [
	    'created_at', 
	    'updated_at'
    ];
}
