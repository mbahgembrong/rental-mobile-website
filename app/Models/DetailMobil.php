<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class DetailMobil
 * @package App\Models
 * @version February 20, 2023, 7:33 am UTC
 *
 * @property uuid $mobil_id
 * @property string $plat
 * @property string $stnk
 * @property string $tahun_mobil
 * @property string $status
 */
class DetailMobil extends Model
{
    use SoftDeletes;

    use HasFactory;

    use \App\Traits\TraitUuid;

    public $table = 'detail_mobils';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'mobil_id',
        'plat',
        'stnk',
        'tahun_mobil',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'plat' => 'string',
        'stnk' => 'string',
        'tahun_mobil' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'mobil_id' => 'required|in_array:mobils.id',
        'plat' => 'required|digits_between:8,12',
        'stnk' => 'required',
        'tahun_mobil' => 'required',
        'status' => 'required'
    ];
    /**
     * Get the mobil that owns the DetailMobil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id')->withTrashed();
    }

    /**
     * Get all of the rental for the DetailMobil
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rental()
    {
        return $this->hasMany(Rental::class, 'detail_mobil_id');
    }

}
