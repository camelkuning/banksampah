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
        'status_terima',
    ];

    /**
     * Get the phone associated with the user.
     */
    public function transaksi()
    {
        return $this->hasOne(PenggunaTransaksi::class, 'bank_id', 'id');
    }

    /**
     * Get the phone associated with the user.
     */
    public function User()
    {
        return $this->hasOne(User::class, 'id', 'UserID');
    }

    /**
     * Get the phone associated with the user.
     */
    public function lokasi()
    {
        return $this->hasOne(BankSampah::class, 'id', 'lokasi_pembuangan');
    }
}
