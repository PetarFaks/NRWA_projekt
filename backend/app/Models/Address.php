<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $primaryKey = 'AddressID';

    protected $fillable = [
        'AddressLine1',
        'AddressLine2',
        'City',
        'PostalCode',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'AddressID');
    }
}
