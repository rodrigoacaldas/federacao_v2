<div class="overlay-success rounded py-2"  data-stellar-background-ratio="0.5" style="background: rgba(238, 198, 10, 0.9);">
    @if(isset($next_matches) )
        @foreach ($next_matches as $next_match)
            <div class="row align-items-center ml-0 mr-0 py-4 match-entry" style="justify-content: center;">
                <div class="col-12 mb-lg-0">
                    @if(isset($all_games))
                        <p class="text-center font-weight-bold" style="margin-top: -15px;">J{{$next_match->category_game_number}} &mdash; {{$next_match->date}} - {{$next_match->hour}} </p>
                    @else
                        <p class="text-center font-weight-bold">{{$next_match->modality_name}} &mdash; {{$next_match->championship_name}}</p>
                        <p class="text-center" style="margin-top: -15px;">{{$next_match->category_name}} &mdash; Jogo {{$next_match->category_game_number}} </p>
                        <p class="text-center font-weight-bold" style="margin-top: -15px;">{{$next_match->date}} - {{$next_match->hour}} </p>
                    @endif
                </div>
                
                <div class="col-5">
                    <div class="text-center text-lg-left">
                        <div class="d-flex align-items-center" style="justify-content: flex-end;">
                            <div class="text mr-2">
                                <h3 class="h5 mb-0 text-black">{{$next_match->club_a_slug}}</h3>
                            </div>
                            <div class="image image-small text-center">
                                <img src="{{url('storage/clubs/'.$next_match->club_a_image)}}" alt="Image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-1 text-center px-0">
                    <div class="d-inline-block">
                        <div class="d-inline-block rounded">
                            <span class="h2" >X</span>
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="text-center text-lg-left">
                        <div class="d-flex align-items-center">
                            <div class="image image-small text-center">
                                <img src="{{url('storage/clubs/'.$next_match->club_b_image)}}" alt="Image" class="img-fluid">
                            </div>
                            <div class="text ml-2">
                                <h3 class="h5 mb-0 text-black">{{$next_match->club_b_slug}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (!$loop->last)
                <div style="border-bottom: 4px dotted black;"></div>
            @endif
        @endforeach
        
    @else
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-4 text-center mb-4 mb-lg-0">
                <div class="d-inline-block">
                    <p class="mb-0" ><small class="text-uppercase text-black font-weight-bold pb-0">Não tem mais jogos cadastrados</small></p>
                </div>
            </div>

        </div>
    @endif
</div>
