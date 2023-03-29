<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class KategoriMobil
 * @package App\Models
 * @version February 20, 2023, 7:31 am UTC
 *
 * @property string $nama
 */
class KategoriMobil extends Model
{
    use SoftDeletes;

    use HasFactory;

    use \App\Traits\TraitUuid;

    public $table = 'kategori_mobils';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nama',
        'foto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'foto' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'required',
        'foto' => 'required|image'
    ];


}