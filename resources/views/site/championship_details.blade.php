@extends('site.template.main')

@section('header')
    <div class="site-blocks-cover overlay" style="background-image: url({{url('storage/championships/'.$championship->header_image)}});" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-start">
                <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
                    <h1 class="bg-text-line">{{$title}}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('content')
    <div class="site-blocks-vs site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h6 text-uppercase text-black font-weight-bold mb-3">Tabelas por categoria</h2>
                    <div class="site-block-tab">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @foreach($categories as $category)
                                <li class="nav-item">
                                    <a class="nav-link @if($loop->index == 0) active @endif " id="pills-home-tab" data-toggle="pill" href="#category-{{$category->id}}" role="tab" aria-controls="pills-home" aria-selected="true">{{$category->name}}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            @foreach($categories as $category)
                                <div class="tab-pane fade show  @if($loop->index == 0) active @endif " id="category-{{$category->id}}" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <table class="table table-striped table-sm table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">P</th>
                                                <th scope="col">J</th>
                                                <th scope="col">V</th>
                                                <th scope="col">E</th>
                                                <th scope="col">D</th>
                                                <th scope="col">GP</th>
                                                <th scope="col">GC</th>
                                                <th scope="col">SG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(json_decode($category->results) as $result)
                                                <tr>
                                                    <th scope="row">{{$loop->index+1}}</th>
                                                    <td>{{$result->club_name}}</td>
                                                    <td>{{$result->points}}</td>
                                                    <td>{{$result->games_played}}</td>
                                                    <td>{{$result->victories}}</td>
                                                    <td>{{$result->draws}}</td>
                                                    <td>{{$result->losts}}</td>
                                                    <td>{{$result->goals_for}}</td>
                                                    <td>{{$result->goals_against}}</td>
                                                    <td>{{$result->goals_difference}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <h6>Atilheiros {{$category->name}}</h6>
                                    <table class="table table-striped table-sm table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Jogador</th>
                                                <th scope="col">Gols</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(json_decode($category->top_scorers) as $top_scorer)
                                            <tr>
                                                <th scope="row">{{$loop->index+1}}</th>
                                                <td>{{$top_scorer->athlete_name}}</td>
                                                <td>{{$top_scorer->goals}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-blocks-vs site-section">
        <div class="container">
            @include('site.matchs.next-match')
        </div>
    </div>

    <div class="site-blocks-vs site-section bg-light">
        <div class="container">
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
