@extends("layouts.master")
@section("title","Odeme")
@section("content")
    <div class="container">
        <div class="bg-content">
            <h2>Sipariş (SP-{{$siparis->id}})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                    <th>Durum</th>
                </tr>

                @foreach($siparis->sepet->sepet_urunler as $sepet_urun)
                <tr >
                    <td style="width: 120px">
                        <a href="{{route('urun',$sepet_urun->ürün->slug)}}">
                            <img src="https://via.placeholder.com/120x100?text=Urunismi">
                        </a>
                    </td>
                    <td>
                        <a href="{{route('urun',$sepet_urun->ürün->slug)}}">
                        {{$sepet_urun->ürün->urun_adi}}
                        </a>
                    </td>
                    <td>{{$sepet_urun->ürün->fiyati}}</td>
                    <td>{{$sepet_urun->adet}} </td>

                    <td>{{$sepet_urun->ürün->fiyati*$sepet_urun->adet}} </td>
                    <td>
                        {{$sepet_urun->durum}}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar </th>
                    <th colspan="2">{{ $siparis->siparis_tutari }}</th>
                    <th></th>
                </tr>

                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar(KDV li) </th>
                    <th colspan="2">{{$siparis->siparis_tutari * ((100+config('cart.tax'))/100)}}</th>
                    <th></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Siparis Durum </th>
                    <th colspan="2">{{$siparis->durum}}</th>
                    <th></th>
                </tr>
            </table>
        </div>
    </div>
@endsection



