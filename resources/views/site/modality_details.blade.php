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
                                <p><a href="#" class="btn btn-primary btn-sm rounded-0 py-3 px-5">Detalhes</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach


    </div>
@endsection


@section('content')

    <div class="site-blocks-vs site-section bg-light">
        <div class="container">

{{--            <div class="border mb-3 rounded d-block d-lg-flex align-items-center p-3 next-match">--}}

{{--                <div class="mr-auto order-md-1 w-60 text-center text-lg-left mb-3 mb-lg-0">--}}
{{--                    Proxima partida--}}
{{--                    <div id="date-countdown"></div>--}}
{{--                </div>--}}

{{--                <div class="ml-auto pr-4 order-md-2">--}}
{{--                    <div class="h5 text-black text-uppercase text-center text-lg-left">--}}
{{--                        <div class="d-block d-md-inline-block mb-3 mb-lg-0">--}}
{{--                            <img src="{{$next_match->club_a_image}}" alt="Image" class="mr-3 image"><span class="d-block d-md-inline-block ml-0 ml-md-3 ml-lg-0">{{$next_match->club_a_name}} </span>--}}
{{--                        </div>--}}
{{--                        <span class="text-muted mx-3 text-normal mb-3 mb-lg-0 d-block d-md-inline ">vs</span>--}}
{{--                        <div class="d-block d-md-inline-block">--}}
{{--                            <img src="{{$next_match->club_b_image}}" alt="Image" class="mr-3 image"><span class="d-block d-md-inline-block ml-0 ml-md-3 ml-lg-0">{{$next_match->club_b_name}}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--            </div>--}}

            <h4>Proxima partida</h4>
            <div class="bg-image overlay-success rounded mb-5" style="background-image: url('{{$next_match->championship_image}}');" data-stellar-background-ratio="0.5">
                <div class="row align-items-center">
                    <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                        <div class="text-center text-lg-left">
                            <div class="d-block d-lg-flex align-items-center">
                                <div class="image mx-auto mb-3 mb-lg-0 mr-lg-3">
                                    <img src="{{url('storage/clubs/'.$next_match->club_a_image)}}" alt="Image" class="img-fluid">
                                </div>
                                <div class="text">
                                    <h3 class="h5 mb-0 text-black">{{$next_match->club_a_name}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 text-center mb-4 mb-lg-0">
                        <div class="d-inline-block">
                            <p class="mb-0" ><small class="text-uppercase text-black font-weight-bold pb-0">{{$next_match->modality_name}} &mdash; {{$next_match->championship_name}}</small></p>
                            <p class="mb-0" style="margin-top: -10px;"><small class="text-uppercase text-black font-weight-bold">  Jogo {{$next_match->category_game_number}} &mdash; {{$next_match->category_name}}</small></p>
                            <p class="mb-0" style="margin-top: -10px;"><small class="text-uppercase text-black font-weight-bold">{{$next_match->date}} as {{$next_match->hour}}</small></p>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-4 text-center text-lg-right">
                        <div class="">
                            <div class="d-block d-lg-flex align-items-center">
                                <div class="image mx-auto ml-lg-3 mb-3 mb-lg-0 order-2">
                                    <img src="{{url('storage/clubs/'.$next_match->club_b_image)}}" alt="Image" class="img-fluid">
                                </div>
                                <div class="text order-1">
                                    <h3 class="h5 mb-0 text-black">{{$next_match->club_b_name}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h2 class="h6 text-uppercase text-black font-weight-bold mb-3">Ultimas Partidas</h2>
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            @foreach($last_matches as $last_match)

                                <div class="row bg-white align-items-center ml-0 mr-0 py-4 match-entry">
                                    <div class="col-12 mb-lg-0">
                                        <p class="text-center">{{$last_match->modality_name}} </p>
                                        <p class="text-center" style="margin-top: -15px;">{{$last_match->championship_name}} &mdash; {{$last_match->category_name}} &mdash; Jogo {{$last_match->category_game_number}} &mdash;{{$last_match->date}} </p>
                                    </div>
                                    <div class="col-md-4 col-lg-4 mb-4 mb-lg-0">

                                        <div class="text-center text-lg-left">
                                            <div class="d-block d-lg-flex align-items-center">
                                                <div class="image image-small text-center mb-3 mb-lg-0 mr-lg-3">
                                                    <img src="{{url('storage/clubs/'.$last_match->club_a_image)}}" alt="Image" class="img-fluid">
                                                </div>
                                                <div class="text">
                                                    <h3 class="h5 mb-0 text-black">{{$last_match->club_a_name}}</h3>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-lg-4 text-center mb-4 mb-lg-0">
                                        <div class="d-inline-block">
                                            <div class="bg-black py-2 px-4 mb-2 text-white d-inline-block rounded">
                                                <span class="h5">{{$last_match->goals_a}} X {{$last_match->goals_b}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 text-center text-lg-right">
                                        <div class="">
                                            <div class="d-block d-lg-flex align-items-center">
                                                <div class="image image-small ml-lg-3 mb-3 mb-lg-0 order-2">
                                                    <img src="{{url('storage/clubs/'.$last_match->club_b_image)}}" alt="Image" class="img-fluid">
                                                </div>
                                                <div class="text order-1 w-100">
                                                    <h3 class="h5 mb-0 text-black">{{$last_match->club_b_name}}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection
