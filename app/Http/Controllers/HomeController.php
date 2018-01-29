<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Purchase;
class HomeController extends Controller
{
    public function index()
    {
        $months = ["",
            "Januari","Febuari","Maret",
            "April","Mei","Juni",
            "Juli","Agustus","September",
            "Oktober","November","Desember"
        ];
        $today_data = $this->today_data();
        $data = $this->table_data();   
        return view('page.home.index',compact("data","months","today_data"));
    }

    private function today_data()
    {   
        $sale = DB::select("
            SELECT SUM(sale_price * quantity) as total_sale FROM sales
            LEFT JOIN sale_details ON sales.id = sale_details.sale_id
            WHERE YEAR(created_at) = YEAR(NOW()) AND DAY(created_at) = DAY(NOW()) AND MONTH(created_at) = MONTH(NOW())  
        ",[]);
        $purchase = DB::select("
            SELECT SUM(purchase_price * quantity) as total_purchase FROM purchases
            LEFT JOIN purchase_details ON purchases.id = purchase_details.purchase_id
            WHERE YEAR(created_at) = YEAR(NOW()) AND DAY(created_at) = DAY(NOW()) AND MONTH(created_at) = MONTH(NOW())  
        ",[]);
        if($sale == null) { $sale = 0;}else{ $sale = $sale[0]->total_sale; }
        if($purchase == null) { $purchase = 0;}else{ $purchase = $purchase[0]->total_purchase; }    
        return array('sale' => $sale, 'purchase' => $purchase);
    }

    private function table_data() 
    {
        $data = DB::select("
            SELECT * FROM (
                SELECT tbl1.year as year,
                tbl1.day as day,
                tbl1.month as month,
                tbl2.totalPurchase as total_purchase, 
                tbl1.totalSale as total_sale,
                tbl1.totalSale - tbl2.totalPurchase as laba
                FROM ( 
                    SELECT YEAR(created_at) as year, MONTH(created_at) as month, DAY(created_at) as day, 
                    SUM(sale_details.quantity * sale_details.sale_price) AS totalSale
                    FROM sales 
                    RIGHT JOIN sale_details ON sales.id = sale_details.sale_id 
                    GROUP BY YEAR(created_at),MONTH(created_at),DAY(created_at) 
                ) AS tbl1
                LEFT OUTER JOIN 
                ( 
                    SELECT YEAR(created_at) as year, MONTH(created_at) as month, DAY(created_at) as day,
                    SUM(purchase_details.quantity * purchase_details.purchase_price) AS totalPurchase 
                    FROM purchases 
                    RIGHT JOIN purchase_details ON purchases.id = purchase_details.purchase_id 
                    GROUP BY YEAR(created_at),MONTH(created_at),DAY(created_at) 
                ) AS tbl2
                ON tbl1.day AND tbl1.month = tbl2.month AND tbl1.year = tbl2.year AND tbl1.day = tbl2.day
                UNION
                SELECT tbl2.year as year,
                tbl2.day as day,
                tbl2.month as month,
                tbl2.totalPurchase as total_purchase, 
                tbl1.totalSale as total_sale,
                tbl1.totalSale - tbl2.totalPurchase as laba
                FROM ( 
                    SELECT YEAR(created_at) as year, MONTH(created_at) as month, DAY(created_at) as day,
                    SUM(sale_details.quantity * sale_details.sale_price) AS totalSale
                    FROM sales 
                    RIGHT JOIN sale_details ON sales.id = sale_details.sale_id 
                    GROUP BY YEAR(created_at),MONTH(created_at),DAY(created_at) 
                ) AS tbl1
                RIGHT OUTER JOIN 
                ( 
                    SELECT YEAR(created_at) as year, MONTH(created_at) as month, DAY(created_at) as day,
                    SUM(purchase_details.quantity * purchase_details.purchase_price) AS totalPurchase 
                    FROM purchases 
                    RIGHT JOIN purchase_details ON purchases.id = purchase_details.purchase_id 
                    GROUP BY YEAR(created_at),MONTH(created_at),DAY(created_at) 
                ) AS tbl2
                ON tbl1.month = tbl2.month AND tbl1.year = tbl2.year AND tbl1.day = tbl2.day
                LIMIT 5
            ) as tbl ORDER BY year DESC, month DESC, day DESC
        ",[]);
        return $data;
    }

    public function chart_data() 
    {
        $reports = DB::select("
            SELECT tbl1.year as year,
            tbl1.month as month,
            tbl2.totalPurchase as total_purchase, 
            tbl1.totalSale as total_sale,
            tbl1.totalSale - tbl2.totalPurchase as laba
            FROM ( 
                SELECT YEAR(created_at) as year, MONTH(created_at) as month, 
                SUM(sale_details.quantity * sale_details.sale_price) AS totalSale
                FROM sales 
                RIGHT JOIN sale_details ON sales.id = sale_details.sale_id 
                GROUP BY MONTH(created_at),YEAR(created_at) 
            ) AS tbl1
            LEFT OUTER JOIN (    
                SELECT YEAR(created_at) as year, MONTH(created_at) as month, 
                SUM(purchase_details.quantity * purchase_details.purchase_price) AS totalPurchase 
                FROM purchases 
                RIGHT JOIN purchase_details ON purchases.id = purchase_details.purchase_id 
                GROUP BY MONTH(created_at),YEAR(created_at) 
            ) AS tbl2
            ON tbl1.month = tbl2.month AND tbl1.year = tbl2.year
            UNION
            SELECT tbl2.year as year,
            tbl2.month as month,
            tbl2.totalPurchase as total_purchase, 
            tbl1.totalSale as total_sale,
            tbl1.totalSale - tbl2.totalPurchase as laba
            FROM ( 
                SELECT YEAR(created_at) as year, MONTH(created_at) as month, 
                SUM(sale_details.quantity * sale_details.sale_price) AS totalSale
                FROM sales 
                RIGHT JOIN sale_details ON sales.id = sale_details.sale_id 
                GROUP BY MONTH(created_at),YEAR(created_at) 
            ) AS tbl1
            RIGHT OUTER JOIN (    
                SELECT YEAR(created_at) as year, MONTH(created_at) as month, 
                SUM(purchase_details.quantity * purchase_details.purchase_price) AS totalPurchase 
                FROM purchases 
                RIGHT JOIN purchase_details ON purchases.id = purchase_details.purchase_id 
                GROUP BY MONTH(created_at),YEAR(created_at) 
            ) AS tbl2
            ON tbl1.month = tbl2.month AND tbl1.year = tbl2.year
            LIMIT 7
        ",[]);
        return $reports;
    }
}
