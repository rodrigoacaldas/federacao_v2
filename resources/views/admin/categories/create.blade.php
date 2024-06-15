@extends('admin.layouts.app')

@section('content')
    <div class="card-body">
        <form class="horizontal-form" action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="championship_id" value="{{$championship->id}}">
            @include('admin.categories.includes.form')

            <a href="{{ url()->previous() }}"><span class="btn btn-info">Voltar </span></a>
            <button class="btn btn-success" type="submit">Cadastrar</button>
        </form>
    </div>
@endsection
