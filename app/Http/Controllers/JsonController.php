<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Purchase;
use DataTables;

class JsonController extends Controller
{
    public function table_categorie()
    {
    	return datatables(Categorie::where('delete_data',false)->get())->toJson();
    }

    public function table_product()
    {
        $products = DB::select(" 
            SELECT products.id as id, categories.name as categorie, 
            products.code_product as code_product, products.sale_price as sale_price,
            sale_details.quantity as stock_out, purchase_details.quantity as stock_in
            FROM products 
            LEFT JOIN sale_details ON sale_details.product_id = products.id
            LEFT JOIN purchase_details ON purchase_details.product_id = products.id
            INNER JOIN categories ON products.categorie_id = categories.id");

        return datatables($products)->toJson();
    }

    public function table_purchase()
    {
        $purchases = Purchase::join(
            "purchase_details","purchases.id","=","purchase_details.purchase_id"
        )->select(
            DB::raw(
                'sum(quantity * purchase_price ) as total, 
                purchases.id as id,
                purchases.purchase_number as number,
                purchases.created_at as datetime'
            )
        )->groupBy("purchases.id","purchases.purchase_number","purchases.created_at")
        ->get();
        return datatables($purchases)->toJson();
    }

    public function table_sale()
    {
        $sales = Sale::join("sale_details","sales.id","=","sale_details.sale_id")
        ->select(
            DB::raw(
                "sum(quantity * sale_price) as total,
                sales.id as id,
                sales.sale_number as number,
                sales.created_at as datetime,
                sales.name as name,
                sales.phone as phone"
            )
        )->groupBy("sales.id","sales.sale_number","sales.created_at","sales.name","sales.phone")->get();
        return datatables($sales)->toJson();
    }
}
