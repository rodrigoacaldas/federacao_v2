@extends('site.template.main')

@section('header')
    <div class="site-blocks-cover overlay" style="background-image: url({{url('storage/modalities/'.$modality->header_image)}});" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-start">
                <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
                    <h1 class="bg-text-line">{{$title}}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('content')

    <div class="site-section" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{url('storage/modalities/'.$modality->logo)}}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 pl-md-5">
                    <h2 class="text-black">{{$title}}</h2>
                    <p class="lead">{!! $modality->description !!}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
