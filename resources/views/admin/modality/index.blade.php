@extends('admin.layouts.app')

@section('create-button')
    <div class="page-title-actions">
        <a data-toggle="tooltip" title="Cadastrar um novo" data-placement="bottom" class="mb-2 mr-2 btn-pill btn-transition btn btn-outline-2x btn-outline-success"
            href="{{route('modalities.create')}}"> <i class="fa fa-plus"></i> Novo
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
                    <th>Qtd Clubes</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($modalities as $modality)
                    <tr>
                        <td> <img width="20" src="{{url('storage/modalities/'.$modality->logo)}}" alt=""></td>
                        <td>{{$modality->name}}</td>
                        <td>{{count($modality->clubs)}}</td>
                        <td>{{$modality->description}}</td>
                        <td>
                            <a href="{{route('modalities.edit', $modality->id)}}">
                                <span style="padding: 5px" class="btn btn-success raised icon"><i class="fa fa-edit"></i> </span>
                            </a>
                            <a href="{{route('modalities.show', $modality->id)}}">
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
