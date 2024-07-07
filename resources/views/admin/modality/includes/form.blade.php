<div class="form-row">
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="name" class="">Nome</label>
            <input name="name" id="name" placeholder="Nome da modalidade" type="text" class="form-control" value="{{$modality->name ?? old('name')}}">
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="email" class="">E-mail</label>
            <input name="email" id="email" placeholder="Email da modalidade" type="text" class="form-control" value="{{$modality->email ?? old('email')}}">
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="phone" class="">Telefone</label>
            <input name="phone" id="phone" placeholder="Telefone da modalidade" type="text" class="form-control" value="{{$modality->phone ?? old('phone')}}">
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="description" class="">Nome</label>
            <textarea name="description" id="description" placeholder="Descrição da modalidade" type="text" class="form-control" >{{$modality->description ?? old('description')}}</textarea>
        </div>
    </div>
</div>

<div class="position-relative form-group">
    <label for="logo" class="">Logo da modalidade </label>
    <input name="logo" id="logo" placeholder="Logo da modalidade" type="file" class="form-control-file  {{ $errors->has('logo') ? ' is-invalid' : '' }}" value="{{$modality->logo ?? old('logo')}}">
</div>

<div class="position-relative form-group">
    <label for="header_image" class="">Header da modalidade </label>
    <input name="header_image" id="header_image" placeholder="Header da modalidade" type="file" class="form-control-file  {{ $errors->has('header_image') ? ' is-invalid' : '' }}" value="{{$modality->header_image ?? old('header_image')}}">
</div>
