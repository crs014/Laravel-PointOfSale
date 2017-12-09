<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $table = "purchase_details";
    protected $guarded = ['id'];
    protected $fillable = ['purchase_id','product_id','quantity','purchase_price'];
    public $timestamps = false;

    public function product()
    {
    	return $this->belongsTo("App\Models\Product");
    }

    public function purchase()
    {
    	return $this->belongsTo("App\Models\Purchase");
    }
}
