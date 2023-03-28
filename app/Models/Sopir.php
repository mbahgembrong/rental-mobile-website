<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Sopir
 * @package App\Models
 * @version February 20, 2023, 7:29 am UTC
 *
 * @property string $nik
 * @property string $nomor_sim
 * @property string $nama
 * @property string $tanggal_lahir
 * @property string $alamat
 * @property string $hp
 * @property string $ktp
 * @property string $sim
 * @property string $email
 * @property string $password
 * @property string $foto
 */
class Sopir extends Model
{
    use SoftDeletes;

    use HasFactory;

    use \App\Traits\TraitUuid;

    public $table = 'sopirs';


    protected $dates = ['deleted_at', 'tanggal_lahir'];



    public $fillable = [
        'nik',
        'nomor_sim',
        'nama',
        'tanggal_lahir',
        'alamat',
        'hp',
        'ktp',
        'sim',
        'email',
        'password',
        'foto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nik' => 'string',
        'nomor_sim' => 'string',
        'nama' => 'string',
        'tanggal_lahir' => 'date',
        'alamat' => 'string',
        'hp' => 'string',
        'ktp' => 'string',
        'sim' => 'string',
        'email' => 'string',
        'password' => 'string',
        'foto' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nik' => 'required|digits:16',
        'nomor_sim' => 'required|digits:12',
        'nama' => 'required',
        'tanggal_lahir' => 'required',
        'alamat' => 'required',
        'hp' => 'required|digits_between:10,15|numeric',
        'ktp' => 'required|image',
        'sim' => 'required|image',
        'email' => 'required|email',
        'foto' => 'required|image'
    ];


}