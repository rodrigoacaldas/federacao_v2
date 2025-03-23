@extends('site.template.main')


@section('content')

    <div class="site-blocks-vs site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h6 text-uppercase text-black font-weight-bold mb-3">Contatos</h2>
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            @foreach($modalities as $modality)

                                <div class="row bg-white align-items-center ml-0 mr-0 py-4 match-entry">
                                    <div class="col-12 mb-lg-0">
                                        <p class="text-center">Modalidade: <b>{{$modality->name}}</b> </p>
                                        <p class="text-center">Email: {{$modality->email}} </p>
                                        <p class="text-center">Telefone: {{$modality->phone}} </p>
                                    </div>
                                    
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
