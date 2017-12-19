<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Purchase;
use DataTables;

class JsonController extends Controller
{

    public function categorie()
    {
    	$categories = Categorie::where('delete_data',false)->all();
    	return response()->json($categories);
    }

    public function product()
    {
    	$products = Product::all();
    	return response()->json($products);	 
    }

    public function sale()
    {
    	$sales = Sale::all();
    	return response()->json($sales);
    }

    public function purchase()
    {
    	$purchases = Purchase::all();
    	return response()->json($purchases);
    }

    public function table_categorie()
    {
    	return datatables(Categorie::where('delete_data',false)->get())->toJson();
    }

	public function table_product()
    {
        $products = Product::join("categories","categories.id","=","products.categorie_id")
                    ->select(
                        'products.id as id',
                        'products.code_product as code_product',
                        'categories.name as categorie',
                        'products.sale_price as sale_price',
                        'products.categorie_id as categorie_id'
                    )->where('products.delete_data',false)->get();
        return datatables($products)->toJson();
    }
}
