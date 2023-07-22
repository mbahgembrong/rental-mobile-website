<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddonRental extends Model
{
    use HasFactory;

    use SoftDeletes;


    use \App\Traits\TraitUuid;

    public $table = 'addon_rentals';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'rental_id',
        'keterangan',
        'jumlah',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'keterangan' => 'string',
        'jumlah' => 'integer',
    ];

    /**
     * Get the rental that owns the DetailMobil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rental()
    {
        return $this->belongsTo(Rental::class, 'rental_id')->withTrashed();
    }
}