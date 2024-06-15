<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="club_a_id" class="">Time A <span class="text-danger">*</span></label>
            <select class="form-control" name="club_a_id" id="club_a_id" style="width: 100%" required>
                <option value="">Escolha um time</option>
                @foreach($clubs as $club)
                    <option value="{{$club->id}}" @if( (isset($game) && $game->club_a_id == $club->id) ) selected @endif>{{$club->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="club_b_id" class="">Time B <span class="text-danger">*</span></label>
            <select class="form-control" name="club_b_id" id="club_b_id" style="width: 100%" required>
                <option value="">Escolha um time</option>
                @foreach($clubs as $club)
                    <option value="{{$club->id}}" @if( (isset($game) && $game->club_b_id == $club->id) ) selected @endif>{{$club->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-3" >
        <div class="form-group">
            <label for="date" class="bmd-label-floating">Data</label>
            <input autocomplete="off" class="form-control" data-toggle="datepicker" name="date" id="date"  type="text" value="{{$game->date ?? old('date')}}">
        </div>
    </div>

    <div class="col-md-3" >
        <div class="form-group">
            <label for="hour" class="bmd-label-floating">Hora</label>
            <input autocomplete="off" class="form-control hour" name="hour" id="hour" type="text" value="{{$game->hour ?? old('hour')}}">
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-3" >
        <div class="form-group">
            <label for="category_game_number" class="bmd-label-floating">Numero do jogo</label>
            <small class="form-text text-muted">Se deixado em baranco vai ser preenchido automaticamente na sequencia. </small>
            <input autocomplete="off" class="form-control" name="category_game_number" id="category_game_number" type="number" value="{{$game->category_game_number ?? old('category_game_number')}}">
        </div>
    </div>
</div>

@push('scripts')
    <!--InputMasks-->
    <script src="{{url('/assets/js/vendors/form-components/input-mask.js')}}"></script>

    <!--Datepickers-->
    <script src="{{url('assets/js/vendors/form-components/datepicker.js')}}"></script>
    <script src="{{url('assets/js/vendors/form-components/datepicker.pt-BR.js')}}"></script>
    <script src="{{url('assets/js/vendors/form-components/daterangepicker.js')}}"></script>
    <script src="{{url('assets/js/vendors/form-components/moment.js')}}"></script>

    <script type="text/javascript">
        $( document ).ready(function() {

            $('.hour').inputmask("99:99");

            $('[data-toggle="datepicker"]').datepicker({
                startDate: moment(),
                format: 'dd/mm/yyyy',
                language: 'pt-BR',
                autoHide: true
            });
        })
    </script>

@endpush

