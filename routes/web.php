<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::get("/", function () {
    return view("page.home.welcome");
});

Route::group(['middleware'=>'auth'],function(){

	Route::group(["prefix" => "products"],function(){
		Route::get("/","ProductController@index")->name("products.index");
		Route::get("/{id}/edit","ProductController@edit")->name("products.edit");
		Route::get("/{id}/delete","ProductController@delete")->name("products.delete");
		Route::post("/","ProductController@store")->name("products.store");
		Route::put("/{id}/edit","ProductController@update")->name("products.update");
		Route::delete("/{id}/delete","ProductController@destroy")->name("products.destroy");
	});
	
	Route::group(["prefix" => "categories"],function(){
		Route::get("/","CategorieController@index")->name("categories.index");
		Route::get("/{id}/edit","CategorieController@edit")->name("categories.edit");
		Route::get("/{id}/delete","CategorieController@delete")->name("categories.delete");
		Route::post("/","CategorieController@store")->name("categories.store");
		Route::put("/{id}/edit","CategorieController@update")->name("categories.update");
		Route::delete("/{id}/delete","CategorieController@destroy")->name("categories.destroy");
	});

	Route::group(["prefix" => "purchases"],function(){
		Route::get("/","PurchaseController@index")->name("purchases.index");
		Route::get("/create","PurchaseController@create")->name("purchases.create");
		Route::get("/{id}","PurchaseController@show")->name("purchases.show");
		Route::get("/{id}/edit","PurchaseController@edit")->name("purchases.edit");
		Route::get("/{id}/delete","PurchaseController@delete")->name("purchases.delete");
		Route::post("/create","PurchaseController@store")->name("purchases.store");
		Route::put("/{id}/edit","PurchaseController@update")->name("purchases.update");
		Route::delete("/{id}/delete","PurchaseController@destroy")->name("purchases.destroy");
	});


	Route::group(["prefix" => "sales"],function(){
		Route::get("/","SaleController@index")->name("sales.index");
		Route::get("/{id}","SaleController@edit")->name("sales.edit");
		Route::get("/{id}/delete","SaleController@delete")->name("sales.delete");
		Route::post("/","SaleController@store")->name("sales.store");
		Route::put("/{id}","SaleController@update")->name("sales");
		Route::delete("/{id}/delete","SaleController@destroy")->name("sales.destroy");
	});

	Route::group(["prefix" => "json"],function(){
		Route::post("/categorie/table","JsonController@table_categorie")->name("json.categorie_table");
		Route::post("/product/table","JsonController@table_product")->name("json.product_table");
		Route::post("/purchase/table","JsonController@table_purchase")->name("json.purchase_table");
	});
});
	
	