<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>

    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu</li>

                <li>
                    <a href="{{route('home')}}" @if((Request::segment(2) == 'home') ||( Request::segment(1) == null)) class="mm-active" @endif>
                        <i class="metismenu-icon pe-7s-home"> </i>Home
                    </a>
                </li>

                <li>
                    <a href="{{route('athletes.index')}}" @if((Request::segment(2) == 'athletes')) class="mm-active" @endif>
                        <i class="metismenu-icon pe-7s-user"> </i>Atletas
                    </a>
                </li>

                <li>
                    <a href="{{route('clubs.index')}}" @if((Request::segment(2) == 'clubs')) class="mm-active" @endif>
                        <i class="metismenu-icon pe-7s-flag"> </i>Clubes
                    </a>
                </li>

                <li>
                    <a href="{{route('modalities.index')}}" @if((Request::segment(2) == 'modalities')) class="mm-active" @endif>
                        <i class="metismenu-icon pe-7s-note2"> </i>Modalidades
                    </a>
                </li>

                <li>
                    <a href="{{route('championships.index')}}" @if((Request::segment(2) == 'championships')) class="mm-active" @endif>
                        <i class="metismenu-icon pe-7s-medal"> </i>Campeonatos
                    </a>
                </li>



                @php $subgroupCadastro = array("referees", "scorers") @endphp
                <li @if( in_array(Request::segment(2) , $subgroupCadastro)) class="mm-active" @endif>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-way"></i>
                        Cadastros
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul @if( in_array(Request::segment(2) , $subgroupCadastro)) class="mm-show" @endif >

                        <li>
                            <a href="{{route('referees.index')}}" @if((Request::segment(2) == 'referees')) class="mm-active" @endif>
                                <i class="metismenu-icon pe-7s-note2"> </i>Arbitros
                            </a>
                        </li>
                        <li>
                            <a href="{{route('scorers.index')}}" @if((Request::segment(2) == 'scorers')) class="mm-active" @endif>
                                <i class="metismenu-icon pe-7s-note2"> </i>Mesários
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
