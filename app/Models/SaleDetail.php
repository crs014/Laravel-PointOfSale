<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
	protected $table = "sale_details";
    protected $guarded = ['id'];
    protected $fillable = ['product_id','sale_id','sale_price','quantity'];
    public $timestamps = false;

    public function sale()
    {
    	return $this->belongsTo("App\Models\Sale");
    }
}
