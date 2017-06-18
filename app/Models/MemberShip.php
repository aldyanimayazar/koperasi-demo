<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberShip extends Model
{
    use SoftDeletes;
    protected $table = 'memberships';

    protected $fillable = [
    	'id', 
    	'name', 
        'nik', 
        'group_id', 
        'member_role_id', 
    	'gender', 
    	'email', 
    	'date_of_birth', 
    	'blood_type', 
    	'religion', 
    	'address', 
    	'phone', 
    	'savings', 
    	'salary', 
    	'max_plafond_debiting',
        'id_member'
    ];

    protected $hidden = ["deleted_at"];

    public function role() 
    {
        return $this->belongsTo('App\Models\MemberRole', 'member_role_id');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
