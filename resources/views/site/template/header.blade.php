<div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-logo">
            <a href="#"><img src="assets/logo-nova.png" alt="Image"></a>
        </div>
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<header class="site-navbar absolute transparent" role="banner">
    <div class="py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 col-md-3">
                    <a href="https://www.facebook.com/federacaocearensedehoquei/" class="text-secondary px-2 pl-0"><span class="icon-facebook"></span></a>
                    <a href="https://www.instagram.com/federacaocearensedehoquei/" class="text-secondary px-2"><span class="icon-instagram"></span></a>
                </div>
                <div class="col-6 col-md-9 text-right">
                    <div class="d-inline-block"><a href="#" class="text-secondary p-2 d-flex align-items-center"><span class="icon-envelope mr-3"></span> <span class="d-none d-md-block">rodrigo@suaempresa.tech</span></a></div>
                    <div class="d-inline-block"><a href="#" class="text-secondary p-2 d-flex align-items-center"><span class="icon-phone mr-0 mr-md-3"></span> <span class="d-none d-md-block">(85) 9 9753 6411</span></a></div>
                </div>
            </div>
        </div>
    </div>
    <nav class="site-navigation position-relative text-right bg-black text-md-right" role="navigation">
        <div class="container position-relative">
            <div class="site-logo">
                <a href="index.html"><img src="assets/logo-nova.png" alt=""></a>
            </div>

            <div class="d-inline-block d-md-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

            <ul class="site-menu js-clone-nav d-none d-md-block">
                <li class="active"> <a href="index.html">Inicio</a> </li>
                <li class="has-children">
                    <a >Modalidades</a>
                    <ul class="dropdown arrow-top">
                        @foreach($modalities as $modality)
                            <li><a href="#">{{$modality->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="has-children">
                    <a >Campeonatos</a>
                    <ul class="dropdown arrow-top">
                        @foreach($modalities as $modality)
                            <li class="has-children">
                                <a href="#">{{$modality->name}}</a>
                                <ul class="dropdown">
                                    @php $count = 0 @endphp
                                    @foreach($championships as $championship)
                                        @if($championship->modality_id == $modality->id)
                                            <li><a href="#">{{$championship->name}}</a></li>
                                            @php $count++ @endphp
                                        @endif
                                    @endforeach

                                    @if($count == 0)
                                        <li><a href="#">Sem Nenhum campeonato nessa modalidade</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="contact.html">Contato</a></li>
            </ul>
        </div>
    </nav>
</header>


