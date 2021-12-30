<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    use HasFactory;

    protected $fillable = [ 'category_code',"item_no",
    "item_code",
    "description",
    "soh",
    "bin",
    "sale_price",
    "status",
    "cost_price",
    "sale_price",
    "reorder_level",
    "country"
];

   
}
