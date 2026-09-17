<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'category',
        'description',
        'total_stock',
        'available_stock',
        'icon',
        'status',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}