@extends("layouts.master")
@section("title","Anasayfa")
@section("content")
    @include('kullanici.aktivasyon_control')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Kategoriler</div>
                    <div class="list-group categories">
                      @foreach($kategoriler as $kategori)
                        <a href="{{route("kategori",$kategori->slug)}}" class="list-group-item">
                            <i class="fa fa-television"></i>
                            {{$kategori->kategori_adi}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i=0;$i<count($slide_urun);$i++)
                            <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="active"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($slide_urun as $index=>$detay)
                            <div class="item {{$index==0 ? 'active' : ' '}}">
                                <img src="https://via.placeholder.com/640x400?text={{$detay->urun->urun_adi}}"alt="...">
                                <div class="carousel-caption">
                                    {{$detay->urun->urun_adi}}
                                </div>
                            </div>
                        @endforeach
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
            <div class="col-md-3">
                <div class="panel panel-default" id="sidebar-product">
                    <div class="panel-heading">{{$gunun_fırsati->urun_adi}}</div>
                    <div class="panel-body">
                        <a href="{{route("urun",$gunun_fırsati->slug)}}">
                            <img src="https://via.placeholder.com/400x485?text={{$gunun_fırsati->urun_adi}}" class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>
    </div>
    <div class="container">
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Öne Çıkan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($one_cikanlar as $urun)
                            <div class="col-md-3 product">
                                <a href="{{route("urun",$urun->slug)}}"><img src="https://via.placeholder.com/400x400?text={{$urun->urun_adi}}"></a>
                                <p><a href="{{route("urun",$urun->slug)}}">{{$urun->urun_adi}}</a></p>
                                <p class="price">{{$urun->fiyati}} ₺</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Çok Satan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($cok_satanlar as $urun)
                            <div class="col-md-3 product">
                                <a href="{{route("urun",$urun->slug)}}"><img src="https://via.placeholder.com/400x400?text={{$urun->urun_adi}}"></a>
                                <p><a href="{{route("urun",$urun->slug)}}">{{$urun->urun_adi}}</a></p>
                                <p class="price">{{$urun->fiyati}} ₺</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">İndirimli Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($indirimli_urunler as $urun)
                            <div class="col-md-3 product">
                                <a href="{{route("urun",$urun->slug)}}"><img src="https://via.placeholder.com/400x400?text={{$urun->urun_adi}}"></a>
                                <p><a href="{{route("urun",$urun->slug)}}">{{$urun->urun_adi}}</a></p>
                                <p class="price">{{$urun->fiyati}} ₺</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
