<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use SoftDeletes;

    use HasFactory;

    use \App\Traits\TraitUuid;

    public $table = 'notifications';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'pelanggan_id',
        'role',
        'title',
        'message',
        'location',
        'is_read',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'role' => 'string',
        'title' => 'string',
        'message' => 'string',
        'location' => 'string',
        'is_read' => 'boolean',
    ];

    /**
     * Get the pelanggan that owns the Notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
}