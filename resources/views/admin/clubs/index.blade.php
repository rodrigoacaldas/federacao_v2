@extends('admin.layouts.app')

@section('create-button')
    <div class="page-title-actions">
        <a data-toggle="tooltip" title="Cadastrar um novo" data-placement="bottom" class="mb-2 mr-2 btn-pill btn-transition btn btn-outline-2x btn-outline-success"
            href="{{route('clubs.create')}}"> <i class="fa fa-plus"></i> Novo
        </a>
    </div>
@endsection

@section('content')

    <div class="card-body">
        <table style="width: 100%;" id="myTable" class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Nome</th>
                    <th>Abreviação</th>
                    <th>Qtd Modalidades</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clubs as $club)
                    <tr>
                        <td> <img width="20" src="{{url('storage/clubs/'.$club->image)}}" alt=""></td>
                        <td>{{$club->name}}</td>
                        <td>{{$club->slug}}</td>
                        <td>{{count($club->modalities)}}</td>
                        <td>{{$club->description}}</td>
                        <td>
                            <a href="{{route('clubs.edit', $club->id)}}">
                                <span style="padding: 5px" class="btn btn-success raised icon"><i class="fa fa-edit"></i> </span>
                            </a>
                            <a href="{{route('clubs.show', $club->id)}}">
                                <span style="padding: 5px" class="btn btn-danger raised icon"><i class="fa fa-trash"></i> </span>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr> <td class="text-center" colspan="5">Nenhum dado para mostrar</td> </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection

@include('admin.layouts.simpleTableConfig')
