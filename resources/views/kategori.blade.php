@extends("layouts.master")
@section("title",$my_kategori->kategori_adi)
@section("content")
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route("anasayfa")}}">Anasayfa</a></li>
            <li><a href="{{route("kategori",$my_kategori->slug)}}">{{$my_kategori->kategori_adi}}</a></li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Kategori Adı</div>
                    <div class="panel-body">
                        <h3>Alt Kategoriler</h3>
                        <div class="list-group categories">
                            @foreach($my_sub_kategori as $kategori)
                                 <a href="{{route("kategori",$kategori->kategori_adi)}}" class="list-group-item"><i class="fa fa-television"></i> {{$kategori->kategori_adi}}</a>
                            @endforeach
                        </div>
                        <h3>Fiyat Aralığı</h3>
                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 100-200
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 200-300
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">
                    @if(count($urunler)==0)
                        <div class="alert alert-danger">
                            <p>Bu kategoriye Ait ürün bulunmamaktadır</p>
                        </div>
                        @else
                            Sırala
                            <a href="?order=coksatan" class="btn btn-default">Çok Satanlar</a>
                            <a href="?order=yeniurun" class="btn btn-default">Yeni Ürünler</a>
                            <hr>
                            <div class="row">
                                @foreach($urunler as $urun)
                                    <div class="col-md-3 product">
                                        <a href="#"><img src="http://lorempixel.com/400/400/food/1"></a>
                                        <p><a href="{{route("urun",$urun->slug)}}">{{$urun->urun_adi}}</a></p>
                                        <p class="price">{{$urun->fiyati}} ₺</p>
                                        <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                                    </div>
                                @endforeach
                            </div>
                        {{request()->has('order') ? $urunler->appends(['order'=>request('order')])->links():$urunler->links()}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

