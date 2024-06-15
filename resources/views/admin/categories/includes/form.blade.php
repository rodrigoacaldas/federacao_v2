<div class="form-row">
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="name" class="">Nome</label>
            <input name="name" id="name" placeholder="Nome da categoria" type="text" class="form-control" value="{{$category->name ?? old('name')}}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="position-relative form-group">
            <label for="age_max" class="">Idade Maxima</label>
            <input name="age_max" id="age_max" placeholder="Idade maxima do atleta para poder participar dessa categoria" type="number" class="form-control" value="{{$category->age_max ?? old('age_max')}}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="position-relative form-group">
            <label for="age_min" class="">Idade Minima</label>
            <input name="age_min" id="age_min" placeholder="Idade minima do atleta para poder participar dessa categoria" type="number" class="form-control" value="{{$category->age_min ?? old('age_min')}}">
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-12">
        <div class="position-relative form-group">
            <label for="clubs[]" class="bmd-label-floating">Times</label>
            <select class="btn-outline-secondary multiselect-dropdown form-control" name="clubs[]" style="width: 100%" multiple="multiple" >
                <option value=""></option>
                @foreach($clubs as $club)
                    <option value="{{$club->id}}" @if( (isset($category) && in_array($club->id , $category_clubs)) ) selected @endif > {{$club->name}} </option>
                @endforeach
            </select>
        </div>
    </div>
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
