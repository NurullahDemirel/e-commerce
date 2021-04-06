<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\UrunModel;
use Gloudemans\Shoppingcart\Facades\Cart as Cart;
use App\Models\SepetModel;
use App\Models\UrunSepetModel;

class SepetController extends Controller
{
    public function index(){
        return view("sepet");
    }

    public function  ekle(Request  $request){
        $myproduct=UrunModel::find($request->id);//ürünü bul

       $kart= Cart::add($myproduct->id,$myproduct->urun_adi,1,$myproduct->fiyati);//göstermek için kart oluştur

       if(auth()->guard('myguard')->check()){//kullanici girisi olmuş mu diye bak

           $aktif_sepet_id=session('aktif_sepet_id');

           if(!isset($aktif_sepet_id)){//yoksa
                    $aktif_sepet=SepetModel::create([
                   'kullanici_id'=>auth()->guard('myguard')->id(),
               ]);//sepet oluştur

               $aktif_sepet_id=$aktif_sepet->id;//id yi al
               session()->put('aktif_sepet_id',$aktif_sepet_id);//session a koy
           }

           UrunSepetModel::updateOrCreate(
               ['sepet_id'=>$aktif_sepet_id,'urun_id'=>$myproduct->id],
               ['adet'=>$kart->qty,'tutar'=>$myproduct->fiyati,'durum'=>'Beklemede']
           );

       }
       else{
           return redirect()->route('kullanici.oturumac');
       }
        return redirect()->route('sepet')
            ->with('mesaj','Ürün sepete eklendi')
            ->with('mesaj_tur','success');
    }

    public function kaldır($rowId){

        if (auth()->guard('myguard')->check()){
            $sepet_urun=Cart::get($rowId);
            $id=$sepet_urun->id;
            UrunSepetModel::where('sepet_id',session('aktif_sepet_id'))->where('urun_id',$id)->delete();
        }

        Cart::remove($rowId);
        return redirect()->route('sepet')
            ->with('mesaj','Ürün başarılı bir şekilde kaldırıldı.')
            ->with('mesaj_tur','success');
    }

    public function boşalt(){
        if (auth()->guard('myguard')->check()){

            UrunSepetModel::where('sepet_id',session('aktif_sepet_id'))->delete();
        }

        Cart::destroy();
        return redirect()->route('sepet');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */

    public function guncelle(Request $request){

        if (auth()->guard('myguard')->check()){

           $sepet_id=session('aktif_sepet_id');
           $kartItem=Cart::get($request->id);
           $adet=$request->adet;

           UrunSepetModel::where('sepet_id',$sepet_id)->where('urun_id',$kartItem->id)
               ->update(['adet'=>$adet]);
        }
        $rowId = $request->id;
        $cart = Cart::update($rowId, $request->adet);
        return response()->json(['mesaj'=>$cart]);
    }

}
