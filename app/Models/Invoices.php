<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Invoices extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        "invoice_number",
        "invoice_Date",
        "due_date",
        "section_id",
        "product",
        "Amount_collection",
        "Amount_commission",
        "Discount",
        "Rate_VAT",
        "Value_VAT",
        "Total",
        "note",
        "Status",
        "Payment_Date",
        "Value_Status",
        "deleted_at",
    ];

    public function sections()
    {
        return $this->belongsTo(Sections::class, "section_id");
    }

    public function products()
    {
        return $this->hasOne(Products::class, "id");
    }
}
