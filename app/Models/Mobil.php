<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    use \App\Traits\TraitUuid;

    public $table = 'mobils';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'kategori_id',
        'nama',
        'jenis',
        'merk',
        'harga',
        'satuan',
        'denda',
        'foto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'jenis' => 'string',
        'merk' => 'string',
        'harga' => 'integer',
        'satuan' => 'string',
        'denda' => 'integer',
        'foto' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'kategori_id' => 'required|exists:kategori_mobils,id',
        'nama' => 'required|string',
        'jenis' => 'required',
        'merk' => 'required',
        'harga' => 'required|numeric',
        'satuan' => 'required|in:jam,hari',
        'denda' => 'required|numeric',
        'foto' => 'required|image',
        'plat.*' => 'required',
        'stnk.*' => 'required',
        'tahun_mobil.*' => 'required|numeric|digits:4'
    ];
    /**
     * Get the kategoriMobil that owns the Mobil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategoriMobil()
    {
        return $this->belongsTo(KategoriMobil::class, 'kategori_id')->withTrashed();
    }
    /**
     * Get all of the detailMobils for the Mobil
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailMobils()
    {
        return $this->hasMany(DetailMobil::class, 'mobil_id', 'id')->withTrashed();
    }

}