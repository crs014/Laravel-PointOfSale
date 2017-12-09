<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = "categories";
    protected $guarded = ['id'];
    protected $fillable = ['name','delete_data'];
    public $timestamps = true;

    public function products()
    {
    	return $this->hasMany("App\Models\Product");
    }
}
