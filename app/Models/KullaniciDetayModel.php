<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KullaniciDetayModel extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='kullanici_detay';
    protected $guarded=[];
    public function kullanci(){
        return $this->belongsTo(Kullanici::class,'kullanici_id','id');
    }
}
