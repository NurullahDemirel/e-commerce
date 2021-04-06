<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route("anasayfa")}}">
                <img src="/img/logo.png">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form method="post" action="{{route('urun_ara')}}" class="navbar-form navbar-left">
                @csrf
                <div class="input-group">
                    <input type="text" id="navbar-search" value="{{old('aranan')}}" name="aranan" class="form-control" placeholder="Ara">
                    <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @guest('myguard')
                <li><a href="{{route("kullanici.oturumac")}}">Oturum Aç</a></li>
                <li><a href="{{route("kullanici.kaydol")}}">Kaydol</a></li>
                @endguest

                @auth('myguard')
                <li><a href="{{route('sepet')}}"><i class="fa fa-shopping-cart"></i> Sepet <span class="badge badge-theme">{{Cart::count()}}</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        {{auth()->guard('myguard')->user()->adsoyad}}
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('siparisler')}}">Siparişlerim</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#" onclick="event.preventDefault();document.getElementById('logout').submit()">Çıkış</a>
                            <form action="{{route('oturum-kapat')}}" id="logout" style="display: none;">@csrf</form>
                        </li>

                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
