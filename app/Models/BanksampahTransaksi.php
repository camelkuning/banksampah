<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanksampahTransaksi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banksampah_transaksi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaksi_id',
        'UserID',
    ];

    /**
     * Get the phone associated with the user.
     */
    public function transaksi()
    {
        return $this->hasMany(PenggunaBankSampah::class, 'id', 'transaksi_id');
    }
}
