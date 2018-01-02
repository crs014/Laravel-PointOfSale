<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleDetail;
use App\Models\SalePayment;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        return view('page.sale.index');
    }

    public function create()
    {
        return view('page.sale.create');
    }

    public function store(Request $request)
    {         
            $sale = new Sale(); 
            $sale->sale_number = strtotime("now");
            $sale->phone = $request->phone;
            $sale->name = $request->name;
            $sale->save();
            $id = $sale->id;

            foreach ($request->product as $key => $value) {
                $product = Product::findOrFail($value);
                $sale_detail = new SaleDetail();
                $sale_detail->product_id = $product->id;
                $sale_detail->sale_price = $product->sale_price;
                $sale_detail->sale_id = $id;
                $sale_detail->quantity = $request->quantity[$key];
                $sale_detail->save();
            }
            return redirect()->route("sales.show",['id' => $id]);
        
     
    }

    private function total_sale($id)
    {
        $total = SaleDetail::where("sale_id","=",$id)->select(DB::raw("sum(sale_price * quantity) as total"))->first();
        return $total->total;
    }

    private function total_payment($id)
    {
        try 
        {
            $total = SalePayment::where("sale_id","=",$id)->select(DB::raw("sum(amount) as total"))->first();
            if($total->total == null) {
                $total->total = 0;
            }
            return $total->total;    
        } 
        catch (\Exception $e) {
            return "Error Exception";
        }
    }

    public function show($id)
    {
        try 
        {
            $status = false;
            $total = $this->total_sale($id);
            $paid = $this->total_payment($id);
            $sale = Sale::findOrFail($id);
            if($paid > $total) {
                $status = true;
            }
            return view("page.sale.show",compact("sale","total","paid","status"));    
        } 
        catch (\Exception $e) 
        {
            return redirect()->route("sales.index");
        }
    }

    public function destroy($id)
    {
        try 
        {
            $sale = Sale::destroy($id);            
        } 
        catch (Exception $e) 
        {
            return redirect()->route("sales.index");           
        }        
    }
}

