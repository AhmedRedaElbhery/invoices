<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices_details extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_invoices",
        "product",
        "invoice_number",
        "section",
        "status",
        "value_status",
        "not",
        "user"
    ];

    public function sections()
    {
        return $this->belongsTo(Sections::class, "section");
    }

}
