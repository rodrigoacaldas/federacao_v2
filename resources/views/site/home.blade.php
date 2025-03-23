@extends('site.template.main')

@section('header')
    <div class="slide-one-item home-slider owl-carousel">
        @foreach($championships as $championship)
            @if($championship->status == 1)
                <div class="site-blocks-cover overlay" style="background-image: url({{url('storage/championships/'.$championship->header_image);}});" data-aos="fade" data-stellar-background-ratio="0.5">
                    <div class="container">
                        <div class="row align-items-center justify-content-start">
                            <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
                                <h1 class="bg-text-line">{{$championship->name}}</h1>
                                <p><a href="{{route('site_championship_details',$championship->id)}}" class="btn btn-primary btn-sm rounded-0 py-3 px-5">Detalhes</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection


@section('content')

    <div class="site-blocks-vs site-section" style="background: #cfcfcf !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h2 class="h6 text-uppercase text-black font-weight-bold mb-3">Ultimas Partidas</h2>
                    @include('site.matches.last-matches')
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <h2 class="h6 text-uppercase text-black font-weight-bold mb-3">Proximas partidas</h2>
                    @include('site.matches.next-matches')
                </div>
            </div>
        </div>
    </div>

@endsection
