<?php

namespace App\Http\Controllers;

use App\Models\invoices_attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesAttachmentController extends Controller
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

        $this->validate(
            $request,
            [

                'file' => 'mimes:pdf,jpeg,png,jpg',
            ],
            [
                'file.mimes' => 'يجب ان تكون الصيفه png,jpg,pdf,jpeg',
            ]
        );
        $invoice_id = $request->invoice_id;
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
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_attachment  $invoices_attachment
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_attachment $invoices_attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_attachment  $invoices_attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_attachment $invoices_attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_attachment  $invoices_attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_attachment $invoices_attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_attachment  $invoices_attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices_attachment $invoices_attachment)
    {
        //
    }
}
