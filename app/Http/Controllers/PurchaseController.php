<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        return view("page.purchase.index");
    }

    public function create()
    {
        return view("page.purchase.create");
    }

    public function store(Request $request)
    {         
            $purchase = new Purchase(); 
            $purchase->purchase_number = strtotime("now");
            $purchase->save();
            $id = $purchase->id;

            foreach ($request->product as $key => $value) {
                $product = Product::findOrFail($value);
                $purchase_detail = new PurchaseDetail();
                $purchase_detail->product_id = $product->id;
                $purchase_detail->purchase_price = $request->price[$key];
                $purchase_detail->purchase_id = $id;
                $purchase_detail->quantity = $request->quantity[$key];
                $purchase_detail->save();
            }
            return redirect()->route("purchases.show",['id' => $id]);
        
     
    }

    public function show($id)
    {
        try 
        {
            $total = PurchaseDetail::where("purchase_id","=",$id)->select(DB::raw("sum(purchase_price * quantity) as total"))->first();
            $total = $total->total;
            $purchase = Purchase::findOrFail($id);
            return view("page.purchase.show",compact("purchase","total"));    
        } 
        catch (\Exception $e) 
        {
            return redirect()->route("purchases.index");
        }
    }

    public function destroy($id)
    {
        try 
        {
            $purchase = Purchase::destroy($id);
        } 
        catch (\Exception $e) 
        {
            return redirect()->route("purchases.index");      
        }   
    }
}
