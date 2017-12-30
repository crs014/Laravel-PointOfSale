<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
	protected $table = "purchases";
    protected $guarded = ['id'];
    protected $fillable = ['purchase_number'];
    public $timestamps = true;

    public function purchase_details()
    {
    	return $this->hasMany("App\Models\PurchaseDetail");
    }
}
