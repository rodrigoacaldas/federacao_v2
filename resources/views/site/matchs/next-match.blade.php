<h4>Proxima partida</h4>
@if(isset($next_match) )
    <div class="bg-image overlay-success rounded mb-5" style="background-image: url('{{$next_match->championship_image}}');" data-stellar-background-ratio="0.5">
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                <div class="text-center text-lg-left">
                    <div class="d-block d-lg-flex align-items-center">
                        <div class="image mx-auto mb-3 mb-lg-0 mr-lg-3">
                            <img src="{{url('storage/clubs/'.$next_match->club_a_image)}}" alt="Image" class="img-fluid">
                        </div>
                        <div class="text">
                            <h3 class="h5 mb-0 text-black">{{$next_match->club_a_name}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 text-center mb-4 mb-lg-0">
                <div class="d-inline-block">
                    <p class="mb-0" ><small class="text-uppercase text-black font-weight-bold pb-0">{{$next_match->modality_name}} &mdash; {{$next_match->championship_name}}</small></p>
                    <p class="mb-0" style="margin-top: -10px;"><small class="text-uppercase text-black font-weight-bold">  Jogo {{$next_match->category_game_number}} &mdash; {{$next_match->category_name}}</small></p>
                    <p class="mb-0" style="margin-top: -10px;"><small class="text-uppercase text-black font-weight-bold">{{$next_match->date}} as {{$next_match->hour}}</small></p>
                </div>
            </div>

            <div class="col-md-12 col-lg-4 text-center text-lg-right">
                <div class="">
                    <div class="d-block d-lg-flex align-items-center">
                        <div class="image mx-auto ml-lg-3 mb-3 mb-lg-0 order-2">
                            <img src="{{url('storage/clubs/'.$next_match->club_b_image)}}" alt="Image" class="img-fluid">
                        </div>
                        <div class="text order-1">
                            <h3 class="h5 mb-0 text-black">{{$next_match->club_b_name}}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@else
    <div class="bg-image overlay-success rounded mb-5" style="" data-stellar-background-ratio="0.5">
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-4 text-center mb-4 mb-lg-0">
                <div class="d-inline-block">
                    <p class="mb-0" ><small class="text-uppercase text-black font-weight-bold pb-0">Não tem mais jogos cadastrados</small></p>
                </div>
            </div>

        </div>
    </div>
@endif
