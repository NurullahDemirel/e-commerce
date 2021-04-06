@extends("layouts.master")
@section("title","Sepet")
@section("content")
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('kullanici.aktivasyon_control')

            @if(count(Cart::content())>0)
                <table class="table table-bordererd table-hover" id="ürünler">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Birim Fiyatı</th>
                    <th>Adet</th>
                    <th>Tutarı</th>
                </tr>
                @foreach(Cart::content() as $urunKartItem)
                <tr>
                    <td style="width: 120px;">
                        <img src="https://via.placeholder.com/120x100?text=Urunismi">
                    </td>
                    <td>
                        <span class="urun-adi" data-id="{{$urunKartItem->rowId}}">{{$urunKartItem->name}}</span>
                        <form action="{{route('sepet-kaldir',$urunKartItem->rowId)}}" method="post">
                            @csrf
                            {{method_field('DELETE')}}
                            <input type="submit" value="Kaldır" class="btn btn-xs btn-danger">
                        </form>
                    </td>

                    <td id="{{$urunKartItem->rowId}}birim">{{$urunKartItem->price}}</td>
                    <td>
                        <a id="minus" href="#" onclick="guncelle('azalt' , '{{$urunKartItem->rowId}}');">-</a>
                        <input type="text"  style="width: 30px" id="{{$urunKartItem->rowId}}" value="{{$urunKartItem->qty}}">
                        <a id="plus" href="#" onclick="guncelle('artır','{{$urunKartItem->rowId}}' )">+</a>
                    </td>
                    <td class="text-right">
                        {{$urunKartItem->subtotal}}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Alt Toplam</th>
                    <th id="subtotal">{{Cart::subtotal()}}</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">KDV</th>
                    <th id="tax">{{Cart::tax()}}</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Genel Toplam</th>
                    <th is="total">{{Cart::total()}}</th>
                </tr>
            </table>
            @else
                <p>Sepetinizde ürün bulunmamaktadır</p>
            @endif
            <div>

                <a href="{{route('anasayfa')}}" class="btn btn-success">

                    {{Cart::count()>0 ? 'Devam et':'Başla'}}
                </a>
                <form action="{{route('sepet-bosalt')}}" method="post" style="display:{{Cart::count()>0 ? 'inline' :'none'}}">
                    @csrf
                    <input type="submit" class="btn btn-info pull-left" value="Sepeti Boşalt">
                </form>
                <a href="{{route('odeme')}}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>

        function guncelle(param,rowId){
            var valueElement = $('#rowId');
            var deger=Math.max(parseInt(document.getElementById(rowId).value));
            var id= rowId;
            (param == 'azalt') ? deger=deger-1 :deger=deger+1;
            (deger<0) ? deger=0 : deger=deger;
            document.getElementById(rowId).value=deger.toString();
            //burada bull

            //degerler geliyor
            $.ajax({
                method:'post',
                url:'/sepet/guncelle',
                data:{'adet':deger, 'id':id, _token: '{{csrf_token()}}' },
                success:function (result) {
                    window.location.href='/sepet';
                }
            });

        }



    </script>
@endsection
