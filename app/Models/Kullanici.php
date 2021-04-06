<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kullanici extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;
    protected $table='kisi';

    protected $fillable = [
        'adsoyad',
        'email',
        'password',
        'aktivasyon_anahtari',
        'akitif_mi'
    ];
    protected $hidden = [
        'aktivasyon_anahtari',
        'password'
    ];
    public function detay(){
        return $this->hasOne(KullaniciDetayModel::class,'kullanici_id','id');
    }



}
