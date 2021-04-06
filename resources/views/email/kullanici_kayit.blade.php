<h1>{{config('app.name')}}</h1>
<p>
    {{$user->adsoyad}},Kaydınızı tamamlamak için
    <a href="{{ route('aktif-et', ['anahtar' => $user->aktivasyon_anahtari]) }}">
        tıklayın
    </a>
</p>
