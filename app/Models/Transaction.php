<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'deskripsi',
        'alamatTujuan',
        'buktiPembayaran',
        'tanggalTransaksi',
        'stokPemesanan',
        'statusPemesanan',
        'metodePembayaran',
        'totalPembayaran',
        'agen_id',
        'supplier_id',
        'product_id'
    ];
}
