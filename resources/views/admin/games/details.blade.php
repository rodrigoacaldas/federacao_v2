@extends('admin.layouts.app')

@section('contentHome')
    <form class="horizontal-form" action="{{ route('game_details.update', $game->id) }}" method="post">
        {!! method_field('PUT') !!}
        @csrf
        <input type="hidden" name="category_id" value="{{$category->id}}">

        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">Jogo {{$game->category_game_id}}</div>
                    </div>
                    <div class="card-body">

                        <p><b>Time A:</b> {{$game->club_a->name}} <b>Gols: </b> {{$game->goals_a}}</p>
                        <p><b>Time B:</b> {{$game->club_b->name}} <b>Gols: </b> {{$game->goals_b}}</p>
                        <p><b>Campeonato: </b>{{$championship->name}}</p>
                        <p><b>Categoria: </b>{{$category->name}}</p>
                        <p><b>Data: </b>{{$game->date}} <b>Hora:</b>{{$game->hour}} </p>


                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="fouls_a" class="font-weight-bold">Faltas time A  <span class="text-danger">*</span></label>
                                <input class="form-control" name="fouls_a" type="number" value="{{$game->fouls_a}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="fouls_b" class="font-weight-bold">Faltas time B  <span class="text-danger">*</span></label>
                                <input class="form-control" name="fouls_b" type="number" value="{{$game->fouls_b}}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">Detalhes</div>
                    </div>
                    <div class="card-body">
                        <label for="referee_1_id" class=""><b>Arbitro 1:</b></label>
                        <select class="form-control" name="referee_1_id" id="referee_1_id" style="width: 100%">
                            <option value="" selected >Escolha um juiz</option>
                            @foreach($referees as $referee)
                                <option value="{{$referee->id}}" @if( (isset($game) && $game->referee_1_id == $referee->id) ) selected @endif>{{$referee->name}}</option>
                            @endforeach
                        </select>

                        <label for="referee_2_id" class=""><b>Arbitro 2:</b></label>
                        <select class="form-control" name="referee_2_id" id="referee_2_id" style="width: 100%">
                            <option value="" selected >Escolha um juiz</option>
                            @foreach($referees as $referee)
                                <option value="{{$referee->id}}" @if( (isset($game) && $game->referee_2_id == $referee->id) ) selected @endif>{{$referee->name}}</option>
                            @endforeach
                        </select>

                        <label for="scorer_1_id" class=""><b>Mesário 1:</b></label>
                        <select class="form-control" name="scorer_1_id" id="scorer_1_id" style="width: 100%">
                            <option value="" selected >Escolha um mesário</option>
                            @foreach($scorers as $scorer)
                                <option value="{{$scorer->id}}" @if( (isset($game) && $game->scorer_1_id == $scorer->id) ) selected @endif>{{$scorer->name}}</option>
                            @endforeach
                        </select>

                        <label for="scorer_2_id" class=""><b>Mesário 2:</b></label>
                        <select class="form-control" name="scorer_2_id" id="scorer_2_id" style="width: 100%">
                            <option value="" selected >Escolha um mesário</option>
                            @foreach($scorers as $scorer)
                                <option value="{{$scorer->id}}" @if( (isset($game) && $game->scorer_2_id == $scorer->id) ) selected @endif>{{$scorer->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">Jogadores {{$game->club_a->name}}</div>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%;" id="myTable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="table-head" style="width: 20%">Posição</th>
                                <th class="table-head" style="width: 50%">Jogador</th>
                                <th class="table-head" style="width: 10%">Gols</th>
                                <th class="table-head" style="width: 10%">Advt</th>
                                <th class="table-head" style="width: 10%">Azul</th>
                                <th class="table-head" style="width: 10%">Vermelho</th>
                            </tr>
                            </thead>


                            <tbody>
                                @php $positions = ['Goleiro 1', 'Goleiro 2', 'Avançado 1', 'Avançado 2', 'Avançado 3', 'Avançado 4', 'Avançado 5', 'Avançado 6', 'Avançado 7', 'Avançado 8'] @endphp
                                @foreach($positions as $position)

                                    @php $this_athete = json_decode($game->{'athlete_a_'.$loop->index+1}) @endphp
                                    <tr>
                                        <td> {{$position}} </td>
                                        <td>
                                            <select class="form-control" name="athlete_a[]" style="width: 100%">
                                                <option value="" selected >Escolha um atleta</option>
{{--                                                <option @if( (isset($game) && $game->athlete_a_1->athlete_id == $athlete_a->id) ) selected @endif>{{$athlete_a->name}}</option>--}}
                                                @foreach($athletes_club_a as $athlete_a)
                                                    <option @if( $this_athete->athlete_id == $athlete_a->id) selected @endif value="{{$athlete_a->id}}" >{{$athlete_a->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td> <input class="form-control" name="goals_a[]" type="number" value="{{$this_athete->goal }}"> </td>
                                        <td> <input class="form-control" name="adv_a[]"   type="number" value="{{$this_athete->advt }}"> </td>
                                        <td> <input class="form-control" name="blue_a[]"  type="number" value="{{$this_athete->blue }}"> </td>
                                        <td> <input class="form-control" name="red_a[]"   type="number" value="{{$this_athete->red }}"> </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">Jogadores {{$game->club_b->name}}</div>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%;" id="myTable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="table-head" style="width: 20%">Posição</th>
                                <th class="table-head" style="width: 50%">Jogador</th>
                                <th class="table-head" style="width: 10%">Gols</th>
                                <th class="table-head" style="width: 10%">Advt</th>
                                <th class="table-head" style="width: 10%">Azul</th>
                                <th class="table-head" style="width: 10%">Vermelho</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($positions as $position)
                                <tr>
                                    <td>{{$position}}</td>
                                    @php $this_athete = json_decode($game->{'athlete_b_'.$loop->index+1}) @endphp
                                    <td>
                                        <select class="form-control" name="athlete_b[]" style="width: 100%">
                                            <option value="" selected >Escolha um atleta</option>
                                            @foreach($athletes_club_b as $athlete_b)
                                                <option @if( $this_athete->athlete_id == $athlete_b->id) selected @endif value="{{$athlete_b->id}}" >{{$athlete_b->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td> <input class="form-control" name="goals_b[]" type="number" value="{{$this_athete->goal }}"> </td>
                                    <td> <input class="form-control" name="adv_b[]"   type="number" value="{{$this_athete->advt }}"> </td>
                                    <td> <input class="form-control" name="blue_b[]"  type="number" value="{{$this_athete->blue }}"> </td>
                                    <td> <input class="form-control" name="red_b[]"   type="number" value="{{$this_athete->red }}"> </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12">
                <a href="{{ url()->previous() }}"><span class="btn btn-info">Voltar </span></a>
                <button type="submit" class="ml-5 btn btn-warning">Finalizar edição</button>
            </div>
        </div>

    </form>
@endsection
