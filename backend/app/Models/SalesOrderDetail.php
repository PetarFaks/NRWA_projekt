<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'SalesOrderDetailID';

    protected $fillable = [
        'UserID',
        'ProductID',
        'OrderQty',
        'UnitPrice',
        'UnitPriceDiscount',
        'OrderDate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    
    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
