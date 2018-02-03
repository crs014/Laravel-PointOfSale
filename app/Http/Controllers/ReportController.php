<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
    	return view("page.report.index");
    }


    public function show($month,$year) 
    {
    	$months = ["",
            "Januari","Febuari","Maret",
            "April","Mei","Juni",
            "Juli","Agustus","September",
            "Oktober","November","Desember"
        ];
        $month_indo = $months[$month];
        $reports = DB::select("
            SELECT tbl1.day as day,IFNULL(tbl2.totalPurchase,0) as total_purchase,  IFNULL(tbl1.totalSale,0) as total_sale
            FROM ( 
                SELECT 
                DATE(created_at) as day, 
                SUM(sale_details.quantity * sale_details.sale_price) AS totalSale
                FROM sales 
                RIGHT JOIN sale_details ON sales.id = sale_details.sale_id 
                WHERE YEAR(created_at) = '$year' AND MONTH(created_at) = '$month'
                GROUP BY DATE(created_at)
            ) AS tbl1
            LEFT OUTER JOIN (    
                SELECT DATE(created_at) as day, 
                SUM(purchase_details.quantity * purchase_details.purchase_price) AS totalPurchase 
                FROM purchases 
                RIGHT JOIN purchase_details ON purchases.id = purchase_details.purchase_id 
                WHERE YEAR(created_at) = '$year' AND MONTH(created_at) = '$month'
                GROUP BY DATE(created_at)
            ) AS tbl2
            ON tbl1.day = tbl2.day
            UNION
            SELECT tbl2.day as day, IFNULL(tbl2.totalPurchase,0) as total_purchase, IFNULL(tbl1.totalSale,0) as total_sale
            FROM ( 
                SELECT DATE(created_at) as day,
                SUM(sale_details.quantity * sale_details.sale_price) AS totalSale
                FROM sales 
                RIGHT JOIN sale_details ON sales.id = sale_details.sale_id 
                WHERE YEAR(created_at) = '$year' AND MONTH(created_at) = '$month'
                GROUP BY DATE(created_at) 
            ) AS tbl1
            RIGHT OUTER JOIN (    
                SELECT DATE(created_at) as day, 
                SUM(purchase_details.quantity * purchase_details.purchase_price) AS totalPurchase 
                FROM purchases 
                RIGHT JOIN purchase_details ON purchases.id = purchase_details.purchase_id 
                WHERE YEAR(created_at) = '$year' AND MONTH(created_at) = '$month'
                GROUP BY DATE(created_at)
            ) AS tbl2
            ON tbl1.day = tbl2.day
        ",[]);
        return view("page.report.show",compact('reports', 'month_indo', 'year'));
    }
}
