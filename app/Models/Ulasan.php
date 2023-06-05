<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use SoftDeletes;

    use HasFactory;

    use \App\Traits\TraitUuid;

    public $table = 'ulasans';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'rental_id',
        'star',
        'ulasan',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'star' => 'string',
        'ulasan' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'rental_id' => 'required|in_array:rentals.id',
        'star' => 'nullable',
        'ulasan' => 'required|string'
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