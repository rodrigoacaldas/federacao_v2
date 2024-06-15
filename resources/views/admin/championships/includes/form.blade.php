<div class="form-row">
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="name" class="">Nome</label>
            <input name="name" id="name" placeholder="Nome do campeonato" type="text" class="form-control" value="{{$championship->name ?? old('name')}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="modality_id" class="bmd-label-floating">Modalidade</label>
            <select class="btn-outline-secondary form-control" name="modality_id" style="width: 100%" >
                <option value=""></option>
                @foreach($modalities as $modality)
                    <option value="{{$modality->id}}" @if( (isset($championship) && ($modality->id == $championship->modality_id)) ) selected @endif > {{$modality->name}} </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-4">
        <div class="position-relative form-group">
            <label for="logo" class="">Logo do campeonato </label>
            <input name="logo" id="logo" placeholder="Logo do campeonato" type="file" class="form-control-file  {{ $errors->has('logo') ? ' is-invalid' : '' }}" value="{{$championship->logo ?? old('logo')}}">
        </div>
    </div>
    <div class="col-md-8">
        <div class="position-relative form-group">
            <label for="header_image" class="">Imagem de cabeçalho do campeonato </label>
            <input name="header_image" id="header_image" placeholder="imagem de cabeçalho" type="file" class="form-control-file  {{ $errors->has('header_image') ? ' is-invalid' : '' }}" value="{{$championship->header_image ?? old('header_image')}}">
        </div>
    </div>
</div>




