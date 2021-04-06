<?php

namespace App\Http\Controllers;
use App\Models\UrunModel;

use Illuminate\Http\Request;

class UrunController extends Controller
{
    public function index($slug){
        $my_product=UrunModel::where("slug",$slug)->firstOrFail();
        $kategoriler=$my_product->kategoriler()->distinct()->get();//distinct bazen aynı ürüne aynı kategori eklenebilir tek olarak gelmesi için
        return view("urun",compact("my_product","kategoriler"));
    }
    public function ara(Request $request){
        $aranan=$request->aranan;
        $urunler=UrunModel::where('urun_adi','like',"%$aranan%")
            ->orWhere('aciklama','like',"%$aranan%")
            ->paginate(2);
        $request->flush();
        return view("arama",compact("urunler","aranan"));
    }

}
