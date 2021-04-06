<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('kategori', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("ust_id")->nullable();
            $table->string("kategori_adi",30);
            $table->string("slug",40);
            $table->timestamps();
            $table->softDeletes();
        });///benim kategori table
        Schema::create('urun', function (Blueprint $table) {
            $table->increments("id");
            $table->string("slug",160);
            $table->string("urun_adi",150);
            $table->text("aciklama");
            $table->decimal("fiyati",6,3);
            $table->timestamps();
            $table->softDeletes();
        });////benim ürün table
        Schema::create('kategoriurun', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->increments("id");
            $table->unsignedInteger('urun_id');
            $table->unsignedInteger('kategori_id');
            Schema::enableForeignKeyConstraints();


            $table->foreign('urun_id')->references('id')->on('urun')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');

        });////benim kategori_urun
        Schema::create("urundetay",function (Blueprint $table){
            $table->increments("id");
            $table->unsignedInteger('urun_id')->unique();
            $table->boolean('goster_slide')->default(0);
            $table->boolean('gunun_firsati')->default(0);
            $table->boolean('one_cikan')->default(0);
            $table->boolean('cok_satan')->default(0);
            $table->boolean('indirimli')->default(0);
            $table->softDeletes();
            $table->foreign('urun_id')->references('id')->on('kategori')->onDelete('cascade');
        });//benim urun detay
        Schema::create('kisi',function (Blueprint $table){
           $table->increments('id');
           $table->string('adsoyad',60);
           $table->string('email',150)->unique();
           $table->string('password',150);
           $table->string('aktivasyon_anahtari',60)->nullable();
           $table->boolean('aktif_mi')->default(0);
           $table->timestamps();
           $table->softDeletes();
        });//benim kisi table
        Schema::create('sepet',function (Blueprint $table){
           $table->increments('id');
           $table->unsignedInteger('kullanici_id');
           $table->timestamps();
           $table->foreign('kullanici_id')->references('id')->on('kisi')->onDelete('cascade');
           $table->softDeletes();
        });//benim sepet table
        Schema::create('sepet_urun',function (Blueprint  $table){
           $table->increments('id');
           $table->unsignedInteger('sepet_id');
           $table->unsignedInteger('urun_id');
           $table->integer('adet');
           $table->decimal('tutar',5,2);
           $table->text('durum');
           $table->timestamps();
           $table->softDeletes();

           $table->foreign('sepet_id')->references('id')->on('sepet')->onDelete('cascade');
           $table->foreign('urun_id')->references('id')->on('urun')->onDelete('cascade');
        });//sepet_urun
        Schema::create(('siparis'),function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('sepet_id');
            $table->string('adsoyad')->nullable();
            $table->string('telefon')->nullable();
            $table->string('ceptelefon')->nullable();
            $table->integer('taksit_sayisi')->nullable();
            $table->decimal('siparis_tutari',10,4);
            $table->string('banka',60)->nullable();
            $table->string('durum',30)->nullable();
            $table->timestamps();
            $table->unique('sepet_id');//tabloda nsadece sepet id si 1 olan tek veri olsun diye.
            $table->foreign('sepet_id')->references('id')->on('sepet')->onDelete('cascade');
            $table->softDeletes();
        });//siparis tablom
        Schema::create('kullanici_detay',function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('kullanici_id');
            $table->text('adres')->nullable();
            $table->string('telefon',15)->nullable();
            $table->string('ceptelefon',15)->nullable();

            $table->foreign('kullanici_id')->references('id')->on('kisi')->onDelete('cascade');
        });//kullanici deyat tablom
        Schema::create('kartlar',function (Blueprint $table){
           $table->increments('id');
           $table->unsignedInteger(('kullanici_id'));
           $table->string('kartSahibi',60);
           $table->string('kartNumarasi')->unique();
           $table->integer('cv');
           $table->integer('sonAy');
           $table->integer('sonYıl');
           $table->foreign('kullanici_id')->references('id')->on('kisi')->onDelete('cascade');
        });//kartlar tablosu
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori');
    }
}
