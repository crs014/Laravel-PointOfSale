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
    	$categories = Categorie::all();
    	return response()->json($categorie);
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
    	return datatables(Categorie::all())->toJson();
    }

	public function table_product()
    {
    	return datatables(Product::all())->toJson();
    }
}
