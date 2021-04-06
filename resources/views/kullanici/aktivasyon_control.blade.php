@if(session()->has('mesaj'))
<div class="container">
    <div class="alert alert-{{session('mesaj_tur')}}">
        <p>{{session('mesaj')}}</p>
    </div>
</div>
@endif
