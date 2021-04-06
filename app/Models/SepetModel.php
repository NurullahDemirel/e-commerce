<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class SepetModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "sepet";

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siparis()
    {
        return $this->belongsTo(SiparisModel::class);
    }
    public function  aktif_sepet_id()
    {
        $id=auth()->guard('myguard')->id();
        $al=SepetModel::where('kullanici_id',$id)->orderByDesc('created_at')->first();
        return  $al->id;
    }
    public function urun_adet(){
        return DB::table('sepet_urun')->where('sepet_id',$this->id)->sum('adet');
    }
    public function sepet_urunler(){
        return $this->hasMany(UrunSepetModel::class,'sepet_id');
    }
}


