@extends('admin.layouts.app')

@section('create-button')
    <div class="page-title-actions">
        <a data-toggle="tooltip" title="Cadastrar um novo" data-placement="bottom" class="mb-2 mr-2 btn-pill btn-transition btn btn-outline-2x btn-outline-success"
            href="{{route('championships.create')}}"> <i class="fa fa-plus"></i> Novo
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
                    <th>Modalidate</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($championships as $championship)
                    <tr>
                        <td> <img width="20" src="{{url('storage/championships/'.$championship->logo)}}" alt=""></td>
                        <td>{{$championship->name}}</td>
                        <td>{{$championship->modality->name}}</td>
                        <td>
                            <a href="{{route('championships.details', $championship->id)}}">
                                <span class="btn btn-info btn-link btn-just-icon"><i class="fa fa-eye"></i> </span>
                            </a>
                            <a href="{{route('championships.edit', $championship->id)}}">
                                <span class="btn btn-success btn-link btn-just-icon"><i class="fa fa-edit"></i> </span>
                            </a>
                            <a href="{{route('championships.show', $championship->id)}}">
                                <span class="btn btn-danger btn-link btn-just-icon"><i class="fa fa-trash"></i> </span>
                            </a>

                        </td>
                    </tr>
                @empty
                    <tr> <td class="text-center" colspan="4">Nenhum dado para mostrar</td> </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection

@include('admin.layouts.simpleTableConfig')
