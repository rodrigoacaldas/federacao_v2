<div class="form-row">
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="name" class="font-weight-bold">Nome  <span class="text-danger">*</span></label>
            <input name="name" id="name" placeholder="Nome do árbitro" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$referee->name ?? old('name')}}">
        </div>
    </div>

    <div class="col-md-3">
        <div class="position-relative form-group">
            <label for="birthday" class="font-weight-bold">Data de nascimento  <span class="text-danger">*</span></label>
            <input name="birthday" id="birthday" placeholder="Data do nascimento" type="text" class="form-control" value="@if(isset($referee)) {{date('d/m/Y', strtotime($referee->birthday))}} @else {{date('d/m/Y')}} @endif">
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-10">
        <div class="position-relative form-group">
            <label for="email" class="font-weight-bold">E-mail</label>
            <input name="email" id="email" placeholder="E-mail" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$referee->email ?? old('email')}}">
        </div>
    </div>
</div>

<div class="form-row">


    <div class="col-md-3">
        <div class="position-relative form-group">
            <label for="cpf" class="font-weight-bold">CPF</label>
            <input name="cpf" id="cpf" placeholder="CPF" type="text" class="form-control {{ $errors->has('cpf') ? ' is-invalid' : '' }}" value="{{$referee->cpf ?? old('cpf')}}">
        </div>
    </div>

</div>

<div class="form-row">
    <div class="col-md-12">
        <div class="position-relative form-group">
            <label for="address" class="font-weight-bold">Endereço</label>
            <input name="address" id="address" placeholder="Endereço" type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{$referee->address ?? old('address')}}">
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="neighborhood" class="font-weight-bold">Bairro</label>
            <input name="neighborhood" id="neighborhood" placeholder="Bairro" type="text" class="form-control {{ $errors->has('neighborhood') ? ' is-invalid' : '' }}" value="{{$referee->neighborhood ?? old('neighborhood')}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="cep" class="font-weight-bold">CEP</label>
            <input name="cep" id="cep" placeholder="CEP" type="text" class="form-control {{ $errors->has('cep') ? ' is-invalid' : '' }}" value="{{$referee->cep ?? old('cep')}}">
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="phone1" class="font-weight-bold">Telefone 1</label>
            <input name="phone1" id="phone1" placeholder="Telefone 1" type="text" class="form-control {{ $errors->has('phone1') ? ' is-invalid' : '' }}" value="{{$referee->phone1 ?? old('phone1')}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="phone2" class="font-weight-bold">Telefone 2</label>
            <input name="phone2" id="phone2" placeholder="Telefone 2" type="text" class="form-control {{ $errors->has('phone2') ? ' is-invalid' : '' }}" value="{{$referee->phone2 ?? old('phone2')}}">
        </div>
    </div>
</div>


<div class="position-relative form-group">
    <label for="referee_image" class="font-weight-bold">Foto do Árbitro</label> <br>
    @if(isset($referee))
        <p>{{'storage/referees/'.$referee->image}}</p>
        <img width="220" src="{{url('storage/referees/'.$referee->image)}}" alt="">
    @endif
    <input name="image" id="image" type="file" class="form-control-file">
</div>


@push('scripts')

    <!--Datepickers-->
    <script src="{{url('/assets/js/vendors/form-components/moment.js')}}"></script>
    <script src="{{url('/assets/js/vendors/form-components/datepicker.js')}}"></script>
    <script src="{{url('/assets/js/vendors/form-components/daterangepicker.js')}}"></script>

    <!--InputMasks-->
    <script src="{{url('/assets/js/vendors/form-components/input-mask.js')}}"></script>

    <script type="text/javascript">
        $( document ).ready(function() {
            $('#installmentCheckbox').change(function () {
                $("#installmentDetails_qtd").toggleClass('d-none');
            });
        });

        $('input[name="birthday"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            "locale": {
                "format": "DD/MM/YYYY",
                "applyLabel": "Aceitar",
                "cancelLabel": "Cancelar",
                "weekLabel": "S",
                "daysOfWeek": [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sab"
                ],
                "monthNames": [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ],
                "firstDay": 1
            },
        });

        $(".money").inputmask( 'currency',{"autoUnmask": true,
            radixPoint:",",
            groupSeparator: ".",
            allowMinus: false,
            prefix: 'r$ ',
            digits: 2,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true
        });

    </script>

@endpush
