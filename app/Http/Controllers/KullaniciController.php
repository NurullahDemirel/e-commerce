<?php

namespace App\Http\Controllers;
use App\Mail\KullaniciKayitMail;
use App\Models\KullaniciDetayModel;
use App\Models\SepetModel;
use App\Models\UrunSepetModel;
use Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Kullanici;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class KullaniciController extends Controller
{
    public function giris_form(){

        return view("kullanici.oturumac");
    }

    public function kaydol_form(){
        return view("kullanici.kaydol");
    }

    public function kaydol_form_submit(Request $request){
        $validated = $request->validate([
            'adsoyad' => 'required|min:5',
            'email' => 'required|unique:kisi|max:150',
            'password'=>'required|confirmed'
        ]);
        $anahtar = str_limit(md5(now()->timestamp), 60);

        $kullanici=Kullanici::create([
           'adsoyad'=>$request->adsoyad,
           'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'aktivasyon_anahtari'=>$anahtar,
            'aktif_mi'=>0
        ]);
        $kullanici->detay()->save(new KullaniciDetayModel());
        Mail::to($request->email)->send(new KullaniciKayitMail($kullanici));
        $arry=['email'=>$request->email,'password'=>$request->password];
        if(auth()->guard('myguard')->attempt($arry)){
            return redirect()->route('anasayfa');
        }

    }

    /**
     * @param $anahtar
     * @return Application|RedirectResponse|Redirector
     */
    public function kullanici_aktif($anahtar){
        $kullanici = Kullanici::whereAktivasyonAnahtari($anahtar)->firstOrFail();
        $kullanici->update(['aktif_mi' => 1]);
        return redirect('/')
            ->with('mesaj','aktivasyon işlemi başarılı')
            ->with('mesaj_tur','success');
    }

    public function kullanici_giris(Request $request){
        $validated = $request->validate([
            'email' => 'required',
            'password'=>'required'
        ]);
        $arry=['email'=>$request->email,'password'=>$request->password];
        if(auth()->guard('myguard')->attempt($arry)){
            $request->session()->regenerate();


            //$aktif_sepet_id=SepetModel::firstOrCreate(['kullanici_id'=>auth()->guard('myguard')->id()])->toArray();
            //first or create bizim kullanıcının sepette kaydı var mı diye bakar yoksa kendi oluşturur.
            //$aktif_id=$aktif_sepet_id['id'];//yukarda oluşturduğu veri tabnı nesnesinden id bilgsini çektik.
            //$aktif_id= (new \App\Models\SepetModel)->aktif_sepet_id();
            $aktif_id= (new \App\Models\SepetModel)->aktif_sepet_id();
            session()->put('aktif_sepet_id',$aktif_id);//session a koyduk
            if(is_null($aktif_id)){

                $aktif_sepet=SepetModel::create([
                   'kullanici_id'=>\auth()->guard('myguard')->user()
                ]);
                $aktif_id=$aktif_sepet->id;
            }

            if(Cart::count()> 0){//kart nesnesinde session da ürün varsa bunları veri tabnına kayıt ettik
                foreach (Cart::content() as $cartItem){
                    UrunSepetModel::updateOrCreate([
                        ['sepet_id'=>$aktif_id,'urun_id'=>$cartItem->id],
                        ['adet'=>$cartItem->qty,'fiyati'=>$cartItem->price,'durum'=>'Beklemede']
                    ]);
                }
            }


            Cart::destroy();//session daki verileri veri tabanına attığımız için artık gerek yok
            //sepeti hep boşaltık üste altda da tüm sepet ürünlerini yeniden sesiona yükledik


            $sepet_urunler=UrunSepetModel::where('sepet_id',$aktif_id)->get();
            foreach ($sepet_urunler as $sepetUrun){
                Cart::add($sepetUrun->ürün->id,$sepetUrun->ürün->urun_adi,$sepetUrun->adet,$sepetUrun->ürün->fiyati);
            }

            return  redirect()
                ->intended('/');
        }
        else{
            $errors=['email'=>'Hatalı giris'];
            return back()->withErrors($errors);
        }
    }

    public function logout(){
        auth()->guard('myguard')->logout();
        \request()->session()->flush();
        return redirect()->route('anasayfa');
    }
}
