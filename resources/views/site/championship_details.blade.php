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
                                                    <td>{{explode( ' ', $result->club_name )[0]}}</td>
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
                                                <th scope="col">Clube</th>
                                                <th scope="col">Gols</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        @foreach(json_decode($category->top_scorers) as $top_scorer)
                                            @if($loop->index == 5) 
                                                @php break; @endphp; 
                                            @endif
                                            <tr>
                                                <th scope="row">{{$loop->index+1}}</th>
                                                <td>{{$top_scorer->athlete_name}}</td>
                                                <td>{{$top_scorer->club_slug}}</td>
                                                <td>{{$top_scorer->goals}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                    <a href="{{route('site_championship_category_all_games',[$championship->id,$category->id])}}" class="btn btn-primary btn-sm rounded-0 py-3 px-3 mt-3">Todos os jogos {{$category->name}}</a>
                                    {{-- <a href="{{route('site_championship_category_statistcs',[$championship->id,$category->id])}}" class="btn btn-primary btn-sm rounded-0 py-3 px-3 ml-2 mt-3">Estatisticas {{$category->name}}</a> --}}

                                    </div>
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
            @include('site.matches.next-matches')
        </div>
    </div>

    <div class="site-blocks-vs site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h6 text-uppercase text-black font-weight-bold mb-3">Ultimas Partidas</h2>
                    @include('site.matches.last-matches')
                </div>
            </div>
        </div>
    </div>

@endsection
