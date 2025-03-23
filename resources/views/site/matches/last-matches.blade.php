@foreach($last_matches as $last_match)
    <div style="background: white !important">

        <div class="row align-items-center ml-0 mr-0 py-4 match-entry" style="justify-content: center;">
            <div class="col-12 mb-lg-0">
                @if(isset($all_games))
                    <p class="text-center" style="margin-top: -15px; font-size: 0.8em;">Jogo {{$last_match->category_game_number}} &mdash;{{$last_match->date}} </p>
                @else
                    <p class="text-center font-weight-bold">{{$last_match->modality_name}} </p>
                    <p class="text-center" style="margin-top: -15px; font-size: 0.8em;">{{$last_match->championship_name}} &mdash; {{$last_match->category_name}} &mdash; Jogo {{$last_match->category_game_number}} &mdash;{{$last_match->date}} </p>
                @endif
            </div>

            <div class="col-4">
                <div class="text-center text-lg-left">
                    <div class="d-flex align-items-center" style="justify-content: flex-end;">
                        <div class="text mr-2">
                            <h3 class="h5 mb-0 text-black">{{$last_match->club_a_slug}}</h3>
                        </div>
                        <div class="image image-small text-center">
                            <img src="{{url('storage/clubs/'.$last_match->club_a_image)}}" alt="Image" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-2 text-center px-0">
                <div class="d-inline-block">
                    <div class="d-inline-block rounded">
                        <span class="h5 font-weight-bold" >{{$last_match->goals_a}} X {{$last_match->goals_b}}</span>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="text-center text-lg-left">
                    <div class="d-flex align-items-center">
                        <div class="image image-small text-center">
                            <img src="{{url('storage/clubs/'.$last_match->club_b_image)}}" alt="Image" class="img-fluid">
                        </div>
                        <div class="text ml-2">
                            <h3 class="h5 mb-0 text-black">{{$last_match->club_b_slug}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endforeach