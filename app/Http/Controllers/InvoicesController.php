<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;
use App\Models\Invoices;
use App\Models\invoices_details;
use App\Models\invoices_attachment;
use App\Models\Sections;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\addinvoice;
use App\Exports\invoiceExport;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $invoices = Invoices::with('sections')->get();
        return view('invoices/invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Sections::all();
        return view('invoices/add_invoices', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_commission' => $request->Amount_Commission,
            'Discount' => $request->discount,
            'Value_VAT' => $request->value_vat,
            'Rate_VAT' => $request->rate_vat,
            'Total' => $request->total,
            'Status' => 'غير مدفوعه',
            'Value_Status' => '2',
            'note' => $request->note,
        ]);

        $invoice_id = Invoices::latest()->first()->id;
        invoices_details::create([
            'id_invoices' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->Section,
            'status' => 'غير مدفوعه',
            'value_status' => '2',
            'not' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoices_attachment();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoices_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);

        }




        return redirect("/invoices");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Invoices::find($id);
        $sections = Sections::all();
        return view('invoices.updatestatus', compact('data', 'sections'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Invoices::find($id);
        $sections = Sections::all();

        return view("/invoices.edit_invoice", compact("data", "sections"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        //dd($request->all());
        Invoices::find($id)->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_commission' => $request->Amount_Commission,
            'Discount' => $request->discount,
            'Value_VAT' => $request->value_vat,
            'Rate_VAT' => $request->rate_vat,
            'Total' => $request->total,
            'note' => $request->note,

        ]);
        invoices_details::where('id_invoices', $id)->update([
            "product" => $request->product,
            "invoice_number" => $request->invoice_number,
            "section" => $request->Section,

            "not" => $request->note
        ]);

        session()->flash('success', 'تم التعديل بنحاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        invoices_details::where('id_invoices', $id)->forceDelete();
        Invoices::where('id', $id)->forceDelete();
        $name = invoices_attachment::where('invoice_number', $id)->pluck('file_name');

        foreach ($name as $fileName) {
            InvoicesDetailsController::deleteFile($id, $fileName);
        }
        return back();
    }

    public function getproducts($id)
    {
        // Fetch products related to the section with the provided ID
        $products = Products::where('section_id', $id)->pluck('product_name', 'id');

        // Return as JSON response
        return response()->json($products);
    }

    public function updatestatus(Request $request)
    {

        if ($request->status_number == 0) {
            $stat = 'مدفوعه';
        } else {
            $stat = 'مدفوعه جزئيا';
        }

        Invoices::find($request->id)->update([
            'Value_Status' => $request->status_number,
            'Status' => $stat,
            'Payment_Date' => date('Y-m-d', strtotime($request->pay_date))
        ]);

        $data = invoices_details::where('id_invoices', $request->id)->orderBy('id', 'desc')->first();
        //dd($data);
        invoices_details::create([
            "id_invoices" => $data->id_invoices,
            "product" => $data->product,
            "invoice_number" => $data->invoice_number,
            "section" => $data->section,
            "status" => $stat,
            "value_status" => $request->status_number,
            "not" => $data->not,
            "user" => $data->user
        ]);

        return InvoicesController::index();

    }

    public function paid_invoices()
    {
        $condition = 'مدفوعه';
        $invoices = Invoices::where('Status', $condition)->with('sections')->get();

        return view('/invoices.paid_invoices', compact('invoices'));
    }
    public function unpaid_invoices()
    {
        $condition = 'غير مدفوعه';
        $invoices = Invoices::where('Status', $condition)->with('sections')->get();

        return view('/invoices.unpaid_invoices', compact('invoices'));
    }

    public function paidpart_invoices()
    {
        $condition = 'مدفوعه جزئيا';
        $invoices = Invoices::where('Status', $condition)->with('sections')->get();

        return view('/invoices.paidpart_invoices', compact('invoices'));
    }

    public function invoice_archive($id)
    {
        Invoices::find($id)->delete();
        $invoices = Invoices::with('sections')->get();
        // return view('/invoices/invoices', compact('invoices'));
        return back()->with('invoices', $invoices);
    }

    public function archives()
    {

        $invoices = Invoices::onlyTrashed('deleted_at')->with('sections')->get();
        return view('/invoices.archives', compact('invoices'));
    }


    public function returntoinvoices($id)
    {

        Invoices::where('id', $id)->restore();

        $invoices = Invoices::onlyTrashed('deleted_at')->with('sections')->get();
        return back()->with('archives', $invoices);

    }

    public function print_invoice($id)
    {
        $data = Invoices::find($id);
        return view('invoices/print_invoice', compact('data'));
    }

    public function export()
    {
        return Excel::download(new invoiceExport, 'users.xlsx');
    }
}
