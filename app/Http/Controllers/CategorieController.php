<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Http\Requests\CategorieRequest;

class CategorieController extends Controller
{
    

    public function index()
    {
        return view("page.categorie.index");
    }

    public function store(CategorieRequest $request)
    {
        try 
        {
            $categorie = new Categorie();
            $categorie->name = $request->name;
            $categorie->delete_data = false;
            $categorie->save();
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('categories.index');
        }
    }

    public function edit($id)
    {
        try 
        {
            $categorie = Categorie::findOrFail($id);
            return response()->json($categorie);      
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('categories.index');
        }
    }

    public function update(CategorieRequest $request, $id)
    {
        try 
        {
            $categorie = Categorie::findOrFail($id);
            $categorie->name = $request->name;
            $categorie->save();      
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('categories.index');
        }
    }

    public function destroy($id)
    {
        try 
        {
            $categorie = Categorie::findOrFail($id);
            $categorie->delete_data = true;
            $categorie->save();      
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('categories.index');
        }
    }
}
