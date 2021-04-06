<?php

namespace App\Http\Controllers;

use App\Models\Kullanici;
use App\Models\UrunModel;
use App\Models\DetayModel;
use Illuminate\Http\Request;
use App\Models\KategoriModel;

class AnasayfaController extends Controller
{
    public function index(){
        $kategoriler=KategoriModel::whereRaw("ust_id is null")->take(8)->get();//ana kategoriler gelsin diye
        $slide_urun=DetayModel::where("goster_slide",1)->take(5)->get();

        $gunun_fırsati=UrunModel::join('urundetay','urundetay.urun_id',"urun.id")
            ->where('urundetay.gunun_firsati',1)
            ->orderBy('updated_at','desc')
            ->first();
        $cok_satanlar=UrunModel::join('urundetay','urundetay.urun_id','urun.id')
            ->where('urundetay.cok_satan',1)
            ->take(4)
            ->get();
        $one_cikanlar=UrunModel::join('urundetay','urundetay.urun_id','urun.id')
            ->where('urundetay.one_cikan',1)
            ->orderBy('updated_at','desc')
            ->take(4)
            ->get();
        $indirimli_urunler=UrunModel::join('urundetay','urundetay.urun_id','urun.id')
            ->where('urundetay.indirimli',1)
            ->orderBy('updated_at','desc')
            ->take(4)
            ->get();
        return view("anasayfa",
            compact('kategoriler','slide_urun','gunun_fırsati','cok_satanlar','one_cikanlar','indirimli_urunler'));
    }
}
