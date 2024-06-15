@extends('admin.layouts.app')

@section('contentHome')
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">Categorias</div>
                    <div class="btn-actions-pane-right text-capitalize">
                        <a href="{{route('categories.create', $championship->id)}}" class="btn-wide btn-outline-2x btn btn-outline-focus btn-sm">Cadastrar Nova</a>
                    </div>
                </div>
                <div class="card-body">
                    <table style="width: 100%;" class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Qtd Times</th>
                            <th>Idade Maxima</th>
                            <th>Idade Minima</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                <td>{{$category->age_max}}</td>
                                <td>{{$category->age_min}}</td>
                                <td>
                                    <a href="{{route('categories.details', $category->id)}}">
                                        <span class="btn btn-info btn-link btn-just-icon"><i class="fa fa-eye"></i> </span>
                                    </a>
                                    <a href="{{route('categories.edit', $category->id)}}">
                                        <span class="btn btn-success btn-link btn-just-icon"><i class="fa fa-edit"></i> </span>
                                    </a>
                                    <a href="{{route('categories.show', $category->id)}}">
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
            </div>
        </div>


    </div>
@endsection
