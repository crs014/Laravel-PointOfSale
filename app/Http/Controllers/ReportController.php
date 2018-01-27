<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Sale;

class ReportController extends Controller
{
    public function index()
    {
    	return view("page.report.index");
    }
}
