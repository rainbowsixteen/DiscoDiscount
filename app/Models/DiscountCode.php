<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $primaryKey = 'discount_code_id';
    public $incrementing = false;
    protected $keyType = 'varchar';
    //To allow an endpoint to edit private key and reference to private key they need to be added as "fillable"
    protected $fillable = [
        'discount_code_id',
        'brands_id'
    ];
}
