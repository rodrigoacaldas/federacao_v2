@extends('admin.layouts.app')

@section('content')
    <div class="card-body">
        <form class="horizontal-form" action="{{ route('scorers.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('admin.scorers.includes.form')

            <a href="{{ url()->previous() }}"><span class="btn btn-info">Voltar </span></a>
            <button class="btn btn-success" type="submit">Cadastrar</button>
        </form>
    </div>
@endsection
