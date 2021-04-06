<?php

namespace App\Http\Controllers;

use App\Models\SiparisModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiparislerController extends Controller
{
    public function index(){
        $siparisler=SiparisModel::with('sepet')
            ->whereHas('sepet',function ($query){//iç içe sorgu yazar
                $query->where('kullanici_id',auth()->guard('myguard')->id());
            })//ilişkili bir tabloda filtrelemeye yarar
            ->orderByDesc('created_at')->get();
        return view("siparisler",compact('siparisler'));
    }
    public function detay($id){
        $siparis=SiparisModel::with('sepet.sepet_urunler.ürün')->where('siparis.id',$id)->firstOrFail();
       ///burası efsane model ile with diyerek istediğin fonksiyonu çağırabiliyorsun sen bana sepet ver ben sepet urune gideyim
        /// ordanda urune
        return view("siparisDetay",compact('siparis'));
    }

}
