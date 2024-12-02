<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\products;
use App\Models\sections;
use Complex\Functions;
use Facade\FlareClient\Report;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    public function index()
    {
        return view('reports/invoices_report');
    }

    public function report_clints()
    {
        $sections = SectionsController::report()->all();
        $products = ProductsController::report()->all();
        return view('reports/report_clints',compact('sections','products'));
    }

    public function search(Request $request)
    {
        $data = InvoicesController::reports($request);
        return back()->with('data',$data);
    }

    public function search_clients(Request $request)
    {
        
        $data = InvoicesController::clint_reports($request);
        return back()->with('data',$data);
    }

    


}
