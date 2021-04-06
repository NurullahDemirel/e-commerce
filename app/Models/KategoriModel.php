<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models;
class KategoriModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="kategori";
    protected $guarded=[];
    public  function  urunler(){
        return $this->belongsToMany(UrunModel::class,"kategoriurun","kategori_id","urun_id");
    }
}
