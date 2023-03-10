<?php

namespace App\Models;

use Eloquent as Model;
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
        'grand_total'
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
        'grand_total' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'pelanggan_id' => 'required|in_array:pelanggans.id',
        'detail_mobil_id' => 'required|in_array:detail_mobils.id',
        'sopir_id' => 'nullable',
        'waktu_peminjaman' => 'required|integer',
        'waktu_mulai' => 'required|integer',
        'waktu_selesai' => 'required|integer',
        'waktu_denda' => 'required|numeric',
        'total' => 'required|integer',
        'denda' => 'required|integer',
        'grand_total' => 'required|integer'
    ];


}
