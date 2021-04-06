<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnasayfaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UrunController;
use App\Http\Controllers\SepetController;
use App\Http\Controllers\OdemeController;
use App\Http\Controllers\SiparislerController;
use App\Http\Controllers\KullaniciController;
use App\Models\Kullanici;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//anasayfa
Route::get("/",[AnasayfaController::class,"index"])->name("anasayfa");


//kategori
Route::get("kategori/{kategori_id}",[KategoriController::class,"index"])->name("kategori");

//odeme
Route::get("/odeme",[OdemeController::class,"index"])->name("odeme");
Route::post("/odeme",[OdemeController::class,"tamamla"])->name("odeme-tamamla");

// // siparis

Route::group(['middleware'=>'auth:myguard'],function (){
    Route::get("siparisler",[SiparislerController::class,"index"])->name("siparisler");
    Route::get("siparisler/{id}",[SiparislerController::class,"detay"])->name("sipariDetay");
});

//sepet
Route::group(['prefix'=>'sepet'],function (){

    Route::get("/",[SepetController::class,"index"])->name("sepet");
    Route::post("/ekle",[SepetController::class,"ekle"])->name("sepet-ekle");
    Route::post("/guncelle",[SepetController::class,"guncelle"])->name("sepet-sayac-guncelle");
    Route::post("/bosalt",[SepetController::class,"boşalt"])->name("sepet-bosalt");
    Route::delete("/kaldir/{rowId}",[SepetController::class,"kaldır"])->name("sepet-kaldir");
});


//urun
Route::post("ara",[UrunController::class,"ara"])->name("urun_ara");
Route::get("ara",[UrunController::class,"ara"])->name("urun_ara");//sayfa değişince post metod gete döner o yüzden
Route::get("urun/{urun_adi}",[UrunController::class,"index"])->name("urun");

//kullanici
Route::group(["prefix"=>"kullanici"],function (){
    Route::get("/oturumac",[KullaniciController::class,"giris_form"])->name("kullanici.oturumac");
    Route::post("/oturumac",[KullaniciController::class,"kullanici_giris"])->name("kullanici.oturumac-submit");
    Route::get("/kaydol",[KullaniciController::class,"kaydol_form"])->name("kullanici.kaydol");
    Route::post("/kaydol",[KullaniciController::class,"kaydol_form_submit"])->name("kayit-ol");
    Route::get("/aktiflestir-ak/{anahtar}",[KullaniciController::class,"kullanici_aktif"])->name("aktif-et");
    Route::get("/logout",[KullaniciController::class,"logout"])->name("oturum-kapat");
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
