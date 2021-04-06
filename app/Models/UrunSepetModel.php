<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UrunSepetModel extends Model
{

    use HasFactory,SoftDeletes;
    protected $table="sepet_urun";
    protected $guarded=[];

    public function ürün()
    {
        return $this->belongsTo(UrunModel::class,'urun_id');
    }
}
