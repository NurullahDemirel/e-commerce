@extends("layouts.master")
@section('content')
    <ol class="breadcrumb">
        <li><a href="{{route('anasayfa')}}">Anasayfa</a></li>
        <li class="active">{{$aranan}}</li>
    </ol>

    <div class="products bg-content">
        <div class="row">
            @if(count($urunler)==0)
                <div class="col-md-12 text-center">
                    Bir Ürün Bulunamad.
                </div>
            @endif
            @foreach($urunler as $urun)
                <div class="col-md-3 product">
                    <a href="{{route('urun',$urun->slug)}}">
                        <img src="https://via.placeholder.com/640x400?text={{$urun->urun_adi}}">

                    </a>
                    <p class="price">
                        <a href="{{route('urun',$urun->slug)}}">{{ $urun->urun_adi }}</a>
                    </p>
                    <p>
                        {{$urun->fiyati}}
                    </p>
                </div>
                @endforeach
        </div>
        {{$urunler->appends(['aranan'=>old('aranan')])->links()}}
    </div>
@endsection()
