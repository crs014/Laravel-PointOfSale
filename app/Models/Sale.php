<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	protected $table = "sales";
    protected $guarded = ['id'];
    protected $fillable = ['sale_number'];
    public $timestamps = true;

	public function sale_details()
    {
    	return $this->hasMany("App\Models\SaleDetail");
    }

    public function sale_payments()
    {
    	return $this->hasMany("App\Models\SalePayment");
    }
}
