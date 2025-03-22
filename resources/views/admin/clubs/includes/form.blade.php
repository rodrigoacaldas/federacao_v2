<div class="form-row">
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="name" class="font-weight-bold">Nome</label>
            <input name="name" id="name" placeholder="Nome do time" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$club->name ?? old('name')}}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="slug" class="font-weight-bold">Abreviação</label>
            <input name="slug" id="slug" placeholder="Abreviação do time" type="text" class="form-control {{ $errors->has('slug') ? ' is-invalid' : '' }}" value="{{$club->slug ?? old('slug')}}">
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-12">
        <div class="position-relative form-group">
            <label for="modalities[]" class="bmd-label-floating">Modalidades</label>
            <select class="btn-outline-secondary multiselect-dropdown form-control" name="modalities[]" style="width: 100%" multiple="multiple" >
                <option value=""></option>
                @foreach($modalities as $modality)
                    <option value="{{$modality->id}}" @if( (isset($club) && in_array($modality->id , $club_modalities)) ) selected @endif > {{$modality->name}} </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="position-relative form-group">
    <label for="image" class="font-weight-bold">Imagem</label>
    @if(isset($club))
        <img width="220" src="{{url('storage/clubs/'.$club->image)}}" alt="">
    @endif
    <input name="image" id="image" type="file" class="form-control-file">
    <small class="form-text text-muted">A logo do clube.</small>
</div>


@push('scripts')
    <!--Multiselect-->
    <script src="{{url('admin/js/vendors/form-components/bootstrap-multiselect.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{url('admin/js/scripts-init/form-components/input-select.js')}}"></script>


    <script>
        $(".multiselect-dropdown").select2({
            theme: "bootstrap4",
            placeholder: "Selecione uma opção",
        });
    </script>

@endpush
