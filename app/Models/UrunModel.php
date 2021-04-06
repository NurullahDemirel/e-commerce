<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models;

class UrunModel extends Model
{
    use HasFactory;
    protected $table="urun";
    protected $guarded=[];
    public function kategoriler(){//many to many
        return $this->belongsToMany(KategoriModel::class,"kategoriurun","kategori_id","urun_id");
    }

    public function detay(){
        return $this->hasOne(DetayModel::class,"urun_id","id");
    }
}
