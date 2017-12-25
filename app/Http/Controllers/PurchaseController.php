<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Http\Requests\PurchaseRequest;

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
        
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
         
    }

    public function destroy($id)
    {
        
    }
}
