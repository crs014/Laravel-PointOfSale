<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiApk extends Model
{
	protected $table = "api_apk";
    protected $guarded = ['id'];
    protected $fillable = ['key_id','key_secret'];
    public $timestamps = true;
}
