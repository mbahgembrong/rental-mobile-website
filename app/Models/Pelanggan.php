<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Pelanggan
 * @package App\Models
 * @version February 20, 2023, 7:25 am UTC
 *
 * @property string $nik
 * @property string $nama
 * @property string $tanggal_lahir
 * @property string $alamat
 * @property string $hp
 * @property string $ktp
 * @property string $email
 * @property string $password
 * @property string $foto
 */
class Pelanggan extends Model
{
    use SoftDeletes;

    use HasFactory;

    use \App\Traits\TraitUuid;

    public $table = 'pelanggans';


    protected $dates = ['deleted_at', 'tanggal_lahir'];
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public $fillable = [
        'nik',
        'nama',
        'tanggal_lahir',
        'alamat',
        'hp',
        'ktp',
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
        'nama' => 'string',
        'tanggal_lahir' => 'date',
        'alamat' => 'string',
        'hp' => 'string',
        'ktp' => 'string',
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
        'nama' => 'required',
        'tanggal_lahir' => 'required',
        'alamat' => 'required',

    ];


}
