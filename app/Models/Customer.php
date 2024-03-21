<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_name',
        'customertype_id',
        'customer_code',
        'sex',
        'dob',
        'phone',
        'passportnumber',
        'country',
    ];

    protected $dates = ['dob', 'created_at', 'updated_at'];

    public function customerType()
    {
        return $this->belongsTo(CustomerType::class, 'customertype_id', 'id');
    }
}
