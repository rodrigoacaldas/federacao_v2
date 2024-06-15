@extends('admin.layouts.app')

@section('create-button')
    <div class="page-title-actions">
        <a data-toggle="tooltip" title="Cadastrar um novo" data-placement="bottom" class="mb-2 mr-2 btn-pill btn-transition btn btn-outline-2x btn-outline-success"
            href="{{route('categories.create')}}"> <i class="fa fa-plus"></i> Novo
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
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $championship)
                    <tr>
                        <td> <img width="20" src="{{url('storage/categories/'.$championship->logo)}}" alt=""></td>
                        <td>{{$championship->name}}</td>
                        <td>{{$championship->description}}</td>
                        <td>
                            <a href="{{route('categories.details', $championship->id)}}">
                                <span class="btn btn-info btn-link btn-just-icon"><i class="fa fa-eye"></i> </span>
                            </a>
                            <a href="{{route('categories.edit', $championship->id)}}">
                                <span class="btn btn-success btn-link btn-just-icon"><i class="fa fa-edit"></i> </span>
                            </a>
                            <a href="{{route('categories.show', $championship->id)}}">
                                <span class="btn btn-danger btn-link btn-just-icon"><i class="fa fa-trash"></i> </span>
                            </a>

                        </td>
                    </tr>
                @empty
                    <tr> <td class="text-center" colspan="3">Nenhum dado para mostrar</td> </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection

@include('admin.layouts.simpleTableConfig')