<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\invoices_details;
use App\Models\invoices_attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoices::find($id);

        $invoicedetails = invoices_details::where('id_invoices', $id)->orderBy('id', 'asc')->get();
        //dd($invoicedetails);
        $invoiceattachment = invoices_attachment::where("invoices_id", $id)->get();

        //dd($invoiceattachment);

        return view("/invoices.invoices_details", compact("invoice", "invoicedetails", "invoiceattachment"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices_details $invoices_details)
    {
        //
    }


    public function openfile($id, $filename)
    {

        $filePath = public_path('Attachments\\' . $id . '/' . $filename);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        abort(404, 'File not found.');
    }

    public static function deletefile($id, $filename)
    {
        File::delete('Attachments/' . $id . "/" . $filename);

        invoices_attachment::where('invoice_number', $id)->where('file_name', $filename)->delete();

        return back();
    }

    public function downloadfile($id, $filename)
    {
        $filePath = public_path('Attachments\\' . $id . '/' . $filename);


        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        abort(404, 'File not found.');
    }
}
