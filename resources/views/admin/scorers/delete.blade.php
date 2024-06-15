@extends('admin.layouts.app')

@section('content')
    <div class="card-body">
        <form class="horizontal-form" method="post" action="{{route('scorers.destroy', $scorer->id)}}">
            {!! method_field('DELETE') !!}
            @csrf
            @include('admin.scorers.includes.form')

            <a href="{{ url()->previous() }}"><span class="btn btn-info">Voltar </span></a>
            <button type="submit" class="btn btn-danger" >Deletar</button>
        </form>
    </div>
@endsection
