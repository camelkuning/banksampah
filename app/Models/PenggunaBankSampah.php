<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaBankSampah extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengguna_banksampah';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'UserID',
        'berat_sampah',
        'jenis_sampah',
        'lokasi_pembuangan',
        'jam',
        'status',
    ];
}
