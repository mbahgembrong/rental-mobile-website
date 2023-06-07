<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Rental
 * @package App\Models
 * @version February 20, 2023, 7:34 am UTC
 *
 * @property uuid $pelanggan_id
 * @property uuid $detail_mobil_id
 * @property uuid $sopir_id
 * @property integer $waktu_peminjaman
 * @property integer $waktu_mulai
 * @property integer $waktu_selesai
 * @property integer $waktu_denda
 * @property integer $total
 * @property integer $denda
 * @property integer $grand_total
 */
class Rental extends Model
{
    use SoftDeletes;

    use HasFactory;

    use \App\Traits\TraitUuid;

    public $table = 'rentals';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'pelanggan_id',
        'detail_mobil_id',
        'sopir_id',
        'waktu_peminjaman',
        'waktu_mulai',
        'waktu_selesai',
        'waktu_denda',
        'total',
        'denda',
        'grand_total',
        'jenis_transaksi',
        'status',
        'status_pembayaran',
        'keterangan',
        'bukti_pembayaran'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'waktu_peminjaman' => 'integer',
        'waktu_mulai' => 'integer',
        'waktu_selesai' => 'integer',
        'waktu_denda' => 'integer',
        'total' => 'integer',
        'denda' => 'integer',
        'grand_total' => 'integer',
        'jenis_transaksi' => 'string',
        'status' => 'string',
        'status_pembayaran' => 'string',
        'keterangan' => 'string',
        'bukti_pembayaran' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'pelanggan_id' => 'required|exists:pelanggans,id',
        'detail_mobil_id' => 'required|exists:detail_mobils,id',
        'sopir_id' => 'nullable|exists:sopirs,id',
        // 'waktu_peminjaman' => 'required|integer',
        'waktu_mulai' => 'required',
        'waktu_selesai' => 'required',
        // 'waktu_denda' => 'required|numeric',
        // 'total' => 'required|integer',
        // 'denda' => 'required|integer',
        'grand_total' => 'required|integer'
    ];
    /**
     * Get the pelanggan that owns the Rental
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id')->withTrashed();
    }
    /**
     * Get the detailMobil that owns the Rental
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function detailMobil()
    {
        return $this->belongsTo(DetailMobil::class, 'detail_mobil_id')->withTrashed();
    }
    /**
     * Get the sopir that owns the Rental
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sopir(): BelongsTo
    {
        return $this->belongsTo(Sopir::class, 'sopir_id')->withTrashed();
    }

    /**
     * Get all of the detailPembayaran for the Rental
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailPembayaran()
    {
        return $this->hasMany(DetailPembayaranRental::class, 'rental_id')->withTrashed();
    }

    /**
     * Get the ulasan associated with the Rental
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'rental_id')->withTrashed();
    }
}