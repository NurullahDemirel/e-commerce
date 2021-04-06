<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models;

class DetayModel extends Model
{
    use HasFactory;
    protected $table="urundetay";
    public $timestamps=false;
    protected $guarded=[];
    public function urun(){
        return $this->belongsTo(UrunModel::class,"urun_id");
    }
}
