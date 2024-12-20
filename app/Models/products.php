<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $fillable = ['product_name', 'description', 'section_id'];

    public function sections()
    {
        return $this->belongsTo(Sections::class, 'section_id');
    }

}
