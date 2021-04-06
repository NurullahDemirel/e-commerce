<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table("kategori")->truncate();
        Schema::enableForeignKeyConstraints();
        $id=DB::table("kategori")->insertGetId(['kategori_adi'=>'Elektronik','slug'=>'elektronik']);
        DB::table("kategori")->insert(['kategori_adi'=>'Bilgisayar\Tablet','slug'=>'bilgisayar-tablet','ust_id'=>$id]);
        DB::table("kategori")->insert(['kategori_adi'=>'Televizyon','slug'=>'televizyon','ust_id'=>$id]);
        DB::table("kategori")->insert(['kategori_adi'=>'Telefon','slug'=>'telefon','ust_id'=>$id]);
        DB::table("kategori")->insert(['kategori_adi'=>'Kamera','slug'=>'kamera','ust_id'=>$id]);

        $id1=DB::table("kategori")->insertGetId(['kategori_adi'=>'Kitap','slug'=>'kitap']);
        DB::table("kategori")->insert(['kategori_adi'=>'Edebiyat','slug'=>'edebiyat','ust_id'=>$id1]);
        DB::table("kategori")->insert(['kategori_adi'=>'Kaşağı','slug'=>'kaşağı','ust_id'=>$id1]);
        DB::table("kategori")->insert(['kategori_adi'=>'Dergi','slug'=>'dergi']);
        DB::table("kategori")->insert(['kategori_adi'=>'Mobilya','slug'=>'mobilya']);
        DB::table("kategori")->insert(['kategori_adi'=>'Dekarasyon','slug'=>'dekarasyon']);
        DB::table("kategori")->insert(['kategori_adi'=>'Kozmetik','slug'=>'kozmetik']);
        DB::table("kategori")->insert(['kategori_adi'=>'Kişisel bakım','slug'=>'kişisel abkım']);
        DB::table("kategori")->insert(['kategori_adi'=>'Giyim ve Moda','slug'=>'giyim ve moda']);
        DB::table("kategori")->insert(['kategori_adi'=>'Anne ve Çocuk','slug'=>'anne ve çocuk']);

    }
}
