<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'name_for_code',
        'type',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'city',
        'telephone_no',
        'mobile_no',
        'fax_no',
        'email',
        'about',
        'credit_balance'
    ];
}
