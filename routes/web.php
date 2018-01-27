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

//Auth::routes();
// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

Route::group(["prefix" => "login"],function(){
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('/', 'Auth\LoginController@login');
});

Route::post('logout', 'Auth\LoginController@logout')->name('logout');
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
		Route::post("/create","PurchaseController@store")->name("purchases.store");
		Route::delete("/{id}/delete","PurchaseController@destroy")->name("purchases.destroy");
	});


	Route::group(["prefix" => "sales"],function(){
		Route::get("/","SaleController@index")->name("sales.index");
		Route::get("/create","SaleController@create")->name("sales.create");
		Route::get("/{id}","SaleController@show")->name("sales.show");
		Route::post("/create","SaleController@store")->name("sales.store");
		Route::post("/{id}/paid","SaleController@paid")->name("sales.paid");
		Route::delete("/{id}/delete","SaleController@destroy")->name("sales.destroy");
	});

	Route::group(["prefix" => "sales"],function(){
		Route::get("/","SaleController@index")->name("sales.index");
		Route::get("/create","SaleController@create")->name("sales.create");
		Route::get("/{id}","SaleController@show")->name("sales.show");
		Route::post("/create","SaleController@store")->name("sales.store");
		Route::post("/{id}/paid","SaleController@paid")->name("sales.paid");
		Route::delete("/{id}/delete","SaleController@destroy")->name("sales.destroy");
	});

	Route::group(["prefix" => "payment"],function(){
		Route::get("/","PaymentController@index")->name("payment.index");
	});

	Route::group(["prefix" => "report"],function(){
		Route::get("/","ReportController@index")->name("report.index");
	});

	Route::group(["prefix" => "json"],function(){
		Route::post("/categorie/table","JsonController@table_categorie")->name("json.categorie_table");
		Route::post("/product/table","JsonController@table_product")->name("json.product_table");
		Route::post("/purchase/table","JsonController@table_purchase")->name("json.purchase_table");
		Route::post("/sale/table","JsonController@table_sale")->name("json.sale_table");
		Route::post("/payment/table","JsonController@table_payment")->name("json.payment_table");
		Route::post("/report/table","JsonController@table_report")->name("json.report_table");
	});
});
	
	