<?php

namespace App\Http\Controllers;
use App\Models\DetayModel;
use App\Models\KategoriModel;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index($kategori_adi){
        $my_kategori=KategoriModel::where("slug",$kategori_adi)->firstOrFail();
        $my_sub_kategori=KategoriModel::where('ust_id',$my_kategori->id)->get();

        $order=request('order');
        if($order=='coksatan'){
            $urunler=$my_kategori->urunler()
                ->join('urundetay','urundetay.urun_id','urun.id')
                ->orderBy('urundetay.cok_satan','desc')
                ->paginate(2);


        }
        elseif ($order='yeniurun'){
            $urunler=$my_kategori->urunler()
                ->orderBy('updated_at','desc')
                ->paginate(2);

        }
        else{
            $urunler=$my_kategori->urunler()->paginate(2);
        }


        return view("kategori",compact("my_kategori","my_sub_kategori","urunler"));
    }
}
