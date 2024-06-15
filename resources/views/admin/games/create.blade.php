@extends('admin.layouts.app')

@section('content')
    <div class="card-body">
        <form class="horizontal-form" action="{{ route('games.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="championship_id" value="{{$category->championship_id}}">
            <input type="hidden" name="category_id" value="{{$category->id}}">

            @include('admin.games.includes.form')

            <a href="{{ url()->previous() }}"><span class="btn btn-info">Voltar </span></a>
            <button class="btn btn-success" type="submit">Cadastrar</button>
        </form>
    </div>
@endsection
