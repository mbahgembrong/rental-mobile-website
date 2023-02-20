<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Mobil
 * @package App\Models
 * @version February 20, 2023, 7:32 am UTC
 *
 * @property uuid $kategori_id
 * @property string $nama
 * @property string $jenis
 * @property string $type
 * @property string $merk
 * @property integer $harga
 * @property string $satuan
 * @property integer $denda
 */
class Mobil extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'mobils';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'kategori_id',
        'nama',
        'jenis',
        'type',
        'merk',
        'harga',
        'satuan',
        'denda'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'jenis' => 'string',
        'type' => 'string',
        'merk' => 'string',
        'harga' => 'integer',
        'satuan' => 'string',
        'denda' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'kategori_id' => 'required|in_array:kategori_mobils.id',
        'nama' => 'required|string',
        'jenis' => 'required',
        'type' => 'required',
        'merk' => 'required',
        'harga' => 'required|numeric',
        'satuan' => 'required|in:jam,hari',
        'denda' => 'required|numeric'
    ];

    
}
