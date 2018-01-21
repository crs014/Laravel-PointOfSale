<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\SalePayment;
use DataTables;

class JsonController extends Controller
{
    public function table_categorie()
    {
    	return datatables(Categorie::where('delete_data',false)->get())->toJson();
    }

    public function table_product()
    {
        $products = Product::select(
            DB::raw(
                "products.id as id,
                categories.name as categorie,
                products.updated_at as date_time,
                products.code_product as code_product,
                products.sale_price as sale_price,
                sale_details.quantity as stock_out,
                purchase_details.quantity as stock_in"
            )
        )
        ->leftJoin(
            DB::raw("
                (SELECT product_id,sum(quantity) as quantity FROM sale_details GROUP BY product_id) sale_details"
            ),function($join) {
                $join->on('products.id', '=', 'sale_details.product_id');
        })
        ->leftJoin(DB::raw("
                (SELECT product_id,sum(quantity) as quantity FROM purchase_details GROUP BY product_id) purchase_details"
            ),function($join) {
                $join->on('products.id', '=', 'purchase_details.product_id');
        })->join('categories', 'categories.id', '=', 'products.categorie_id')->where("products.delete_data","=",0)->get();
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
        ->get()->sortByDesc("created_at");
        return datatables($purchases)->toJson();
    }

    public function table_sale()
    {
        $sales = Sale::select(
            DB::raw(
                "sale_details.totalSale as total,
                sales.id as id,
                sales.sale_number as number,
                sales.created_at as datetime,
                sales.name as name,
                sales.phone as phone,
                sale_payments.totalPaid as paid"
            )
        )
        ->join(
            DB::raw("
                (SELECT sale_id,sum(quantity * sale_price) as totalSale FROM sale_details GROUP BY sale_id) sale_details"
            ),function($join) {
                $join->on('sales.id', '=', 'sale_details.sale_id');
        })
        ->leftJoin(DB::raw("
                (SELECT sale_id,sum(amount) as totalPaid FROM sale_payments GROUP BY sale_id) sale_payments"
            ),function($join) {
                $join->on('sales.id', '=', 'sale_payments.sale_id');
        })->get();
        return datatables($sales)->toJson();
    }

    public function table_payment() 
    {
        $payment = SalePayment::select(
            DB::raw(
                "sale_payments.amount as amount,
                sales.sale_number as number,
                sale_payments.created_at as datetime"
            )
        )->leftJoin("sales","sales.id","=","sale_payments.sale_id")->get();
        return datatables($payment)->toJson(); 
    }
}
