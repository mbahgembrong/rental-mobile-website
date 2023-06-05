<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembayaranRental extends Model
{
    use SoftDeletes;

    use HasFactory;

    use \App\Traits\TraitUuid;

    public $table = 'detail_pembayaran_rentals';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'rental_id',
        'jumlah',
        'kurang',
        'bukti',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'jumlah' => 'integer',
        'kurang' => 'integer',
        'bukti' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'rental_id' => 'required|in_array:rentals.id',
        'jumlah' => 'required|numeric',
        'bukti' => 'nullable|image'
    ];
    /**
     * Get the rental that owns the DetailMobil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rental()
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }
}