<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;

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
