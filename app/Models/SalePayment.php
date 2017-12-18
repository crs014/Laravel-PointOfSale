<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    protected $table = "sale_payments";
    protected $guarded = ['id'];
    protected $fillable = ['code_product','sale_price','delete_data',];
    public $timestamps = true;

    public function sale()
    {
    	return $this->belongsTo("App\Models\Sale");
    }
}
