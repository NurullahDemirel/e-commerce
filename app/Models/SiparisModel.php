<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiparisModel extends Model
{
    use HasFactory;

    protected $table='siparis';

    public $timestamps = false;

    protected $guarded = [];

    /**
     * @return BelongsTo
     * sen bana siparisi ver ben sepeti bulurum.
     */
    public function sepet()
    {
        return $this->belongsTo(SepetModel::class,'sepet_id');
    }
}
