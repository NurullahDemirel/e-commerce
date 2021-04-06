@extends("layouts.master")
@section("title","Odeme")
@section("content")
    <div class="container">
        <div class="bg-content">
            <form action="{{route('odeme-tamamla')}}"  method="post">
                @csrf
                <h2>Ödeme</h2>
                <div class="row">
                    <div class="col-md-5">
                        <h3>Ödeme Bilgileri</h3>

                        {{--Kart numarası cartnumber--}}
                        <div class="form-group">
                            <label for="kartno">Kredi Kartı Numarası</label>
                            <input type="text" class="form-control kredikarti" id="kart_numarası" name="kartNumarası" style="font-size:20px;" required>
                        </div>
                        {{--kart biligleri cardexpiredatemonth,cardexpiredateyear--}}
                        <div class="form-group">
                            <label for="cardexpiredatemonth">Son Kullanma Tarihi</label>
                            <div class="row">
                                <div class="col-md-6">
                                    Ay
                                    <select name="son_ay" id="sonAy" class="form-control" required>
                                        <option>1</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    Yıl
                                    <select name="sonYıl" class="form-control" required>
                                        <option>2017</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{--bitti--}}

                        {{--kart cv:cardcvv2,--}}
                        <div class="form-group">
                            <label for="cardcvv2">CVV (Güvenlik Numarası)</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control kredikarti_cvv" name="kardCv" id="cardcvv2" required>
                                </div>
                            </div>
                        </div>

                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" checked> Ön bilgilendirme formunu okudum ve kabul ediyorum.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" checked> Mesafeli satış sözleşmesini okudum ve kabul ediyorum.</label>
                                </div>
                            </div>
                        </form>
                        <button type="submit" class="btn btn-success btn-lg">Ödeme Yap</button>
                    </div>
                    <div class="col-md-7">
                        <h4>Ödenecek Tutar</h4>
                        <span class="price">{{Cart::total()}} <small>TL</small></span>
                        <h4>İletişim ve Fatura Biligileri</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="adsoyad">Ad Soyad</label>
                                    <input type="text" class="form-group" id="adsoyad"
                                           name="adsoyad" required value="{{auth()->guard('myguard')->user()->adsoyad}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="adres">Adres</label>
                                    <input type="text" class="form-group" id="adres" name="adres" required value="{{  $kullanici_detay->adres}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mr-0" >
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="telefon">Telefon</label>
                                        <input type="text" class="form-group telefon" id="telefon"
                                               value="{{  $kullanici_detay->telefon}}" name="telefon" required>
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cep">Cep telefonu</label>
                                    <input type="text" class="form-group telefon"
                                           value="{{  $kullanici_detay->ceptelefon}}" name="cep" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section("footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script>
        $('.kredikarti').mask('0000-0000-0000-0000', { placeholder: "____-____-____-____" });
        $('.kredikarti_cvv').mask('000', { placeholder: "___" });
        $('.telefon').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
    </script>
@endsection


