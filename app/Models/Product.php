<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $guarded = ['id'];
    protected $fillable = ['code_product','sale_price','delete_data'];
    public $timestamps = true;

    public function categorie()
    {
    	return $this->belongsTo("App\Models\Categorie");
    }

    public function purchase_details()
    {
    	return $this->hasMany("App\Models\PurchaseDetail");
    }

	public function sale_details()
    {
    	return $this->hasMany("App\Models\SaleDetail");
    }
}
