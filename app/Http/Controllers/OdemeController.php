<?php

namespace App\Http\Controllers;

use App\Models\SiparisModel;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Schema;
class OdemeController extends Controller
{
    public function index(){
        if(!(auth()->guard('myguard')->check())){
            return redirect()
                ->route('kullanici.oturumac')
                ->with('mesaj','Ödeme sayfasına gidebilmek için giriş yapmalısınız')
                ->with('mesaj_tur','danger');
        }

        elseif((auth()->guard('myguard')->check())){
            if (count(Cart::content())==0){
                return redirect()->route('anasayfa')
                    ->with('mesaj','Ödeme işleminiz için sepetinizde ürünn bulunmamaktadır')
                    ->with('mesaj_tur','info');
            }

            $kullanici_detay=auth()->guard('myguard')->user()->detay;


            return view('odeme',compact('kullanici_detay'));
        }
    }
    public  function tamamla(Request $request){
        //Buraya gelen bilgileri sanal post hizmeti aldığımız bankanın adresine yönlendiririz
        //burada sepetin biligisi yok id değeri biz bunu almalıyız.
        $bilgiler=$request->all();

        //aşağıda elle eklediğim biligleri ban banka vermesi gerekiyordu.
        $bilgiler['sepet_id']=session('aktif_sepet_id');
        $bilgiler['banka']='Garanti';
        $bilgiler['taksit_sayisi']=1;
        $bilgiler['durum']='Siparisiniz alındı';
        $bilgiler['siparis_tutari']=Cart::subTotal();

        Schema::disableForeignKeyConstraints();
        SiparisModel::create([
            'sepet_id'=>$bilgiler['sepet_id'],

            'adsoyad'=>$bilgiler['adsoyad'],
            'telefon'=>$bilgiler['telefon'],
            'ceptelefon'=>$bilgiler['cep'],
            'taksit_sayisi'=>$bilgiler['taksit_sayisi'],
            'siparis_tutari'=>$bilgiler['siparis_tutari'],
            'banka'=>$bilgiler['banka'],
            'durum'=>$bilgiler['durum']
        ]);
        Schema::enableForeignKeyConstraints();
        //bilgileri attık biz bir kontrol yapıp kullanıcı ile banka arasındaki alış verişi kontrol edip oraya bir durum belirteçi kayabiliriz.
        //eğer olumlu bir dönüş oldu ise bu bilgileri ister kaydeder ister sileriz ama sepeti her türlü kapatırız.

        Cart::destroy();
        session()->forget('aktif_sepet_id');//sepet bilgisinide kapattık

        return redirect()->route('siparisler')
            ->with('mesaj','Siparişiniz başarılı bir şekilde gerçekleştirdiniz')
            ->with('mesaj_tur','success');

    }

}
