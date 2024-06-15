@extends('admin.layouts.app')

@section('contentHome')
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">Jogos</div>
                    <div class="btn-actions-pane-right text-capitalize">
                        <a href="{{route('game.create', $category->id)}}" class="btn-wide btn-outline-2x btn btn-outline-focus btn-sm">Cadastrar Novo</a>
                    </div>
                </div>
                <div class="card-body">
                    <table style="width: 100%;" class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Time A</th>
                            <th>Time B</th>
                            <th>Data</th>
                            <th>Horario</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($games as $game)
                            <tr>
                                <td>{{$game->category_game_number}}</td>
                                <td>{{$game->club_a->name}}</td>
                                <td>{{$game->club_b->name}}</td>
                                <td>{{$game->date}}</td>
                                <td>{{$game->hour}}</td>
                                <td>{{$game->status}}</td>
                                <td>
                                    <a href="{{route('game.details', $game->id)}}">
                                        <span class="btn btn-info btn-link btn-just-icon"><i class="fa fa-list-ul"></i> </span>
                                    </a>
                                    <a href="{{route('games.edit', $game->id)}}">
                                        <span class="btn btn-success btn-link btn-just-icon"><i class="fa fa-edit"></i> </span>
                                    </a>
                                    <a href="{{route('games.show', $game->id)}}">
                                        <span class="btn btn-danger btn-link btn-just-icon"><i class="fa fa-trash"></i> </span>
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr> <td class="text-center" colspan="6">Nenhum dado para mostrar</td> </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection

@include('admin.layouts.simpleTableConfig')
