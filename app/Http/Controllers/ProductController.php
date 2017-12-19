<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorie;

class ProductController extends Controller
{
    public function index()
    {
    	$categories = Categorie::where("delete_data",false)->get();
        return view('page.product.index',compact('categories'));
    }

    public function store(Request $request)
    {
        try 
        {
    		$product = new Product();
    		$product->categorie_id = $request->categorie;
    		$product->code_product = $request->code;
    		$product->sale_price = $request->price;
    		$product->delete_data = false;
    		$product->save();
        } 
        catch (\Exception $e) 
        {
        	return redirect()->route('products.index');
        }
    }

    public function edit($id)
    {
    	try 
    	{
    		$product = Product::findOrFail($id);
    		return response()->json($product);
    	} 
    	catch (\Exception $e) 
    	{
    		return redirect()->route('products.index');	
    	}
    }

    public function update(Request $request, $id)
    {
        try 
        {
            $product = Product::findOrFail($id);
            $product->categorie_id = $request->categorie;
    		$product->code_product = $request->code;
    		$product->sale_price = $request->price;
            $product->save();      
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('products.index');
        }
    }

    public function destroy($id)
    {
        try 
        {     	
            $product = Product::findOrFail($id);
            $product->delete_data = true;
            $product->save();      
        } 
        catch (\Exception $e) 
        {
        	return redirect()->route('products.index');	
        }
    }
}
