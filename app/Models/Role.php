<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = "roles";
    protected $guarded = ['id'];
    protected $fillable = ['user_id','name'];
    public $timestamps = true;

    public function user()
    {
    	return $this->belongsTo("App\Models\User");
    }
}
