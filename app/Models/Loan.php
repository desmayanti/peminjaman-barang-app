<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_code',
        'item_id',
        'nickname',
        'borrower_name',
        'phone_number',
        'email',
        'quantity',
        'borrow_date',
        'return_date',
        'tanggal_selesai',
        'type',
        'purpose',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function getTanggalSelesaiAttribute($value)
    {
        return $value ?? $this->return_date;
    }

    public function getReturnDateAttribute($value)
    {
        return $value ?? $this->attributes['tanggal_selesai'] ?? null;
    }

    public function getTypeAttribute($value)
    {
        if ($value) {
            return $value;
        }
        if ($this->item && $this->item->is_consumable) {
            return 'minta';
        }
        if (empty($this->return_date) && empty($this->attributes['tanggal_selesai'] ?? null)) {
            return 'minta';
        }
        return 'pinjam';
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'pending' => ['label' => 'Menunggu Persetujuan', 'color' => 'bg-amber-100 text-amber-800 border-amber-300'],
            'approved' => ['label' => 'Disetujui', 'color' => 'bg-emerald-100 text-emerald-800 border-emerald-300'],
            'rejected' => ['label' => 'Ditolak', 'color' => 'bg-rose-100 text-rose-800 border-rose-300'],
            'returned' => ['label' => 'Selesai / Dikembalikan', 'color' => 'bg-blue-100 text-blue-800 border-blue-300'],
            default => ['label' => ucfirst($this->status), 'color' => 'bg-gray-100 text-gray-800 border-gray-300'],
        };
    }
}