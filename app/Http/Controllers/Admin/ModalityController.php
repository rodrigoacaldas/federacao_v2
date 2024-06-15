<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ModalityFormRequest;
use App\Models\Admin\Modality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ModalityController extends Controller
{
    public function __construct()
    {
        $icon = 'pe-7s-culture icon-gradient bg-ripe-malin';
        // Sharing is caring
        View::share('icon', $icon);
    }
    public function index()
    {
        $modalities = Modality::all();
        $title = 'Modalidades';

        return view('admin.modality.index', compact('modalities', 'title'));
    }

    public function create()
    {
        $title = 'Cadastro de Modalidade';

        return view('admin.modality.create', compact('title'));
    }

    public function store(ModalityFormRequest $request)
    {
        $dataForm = $request->all();

        $dataForm['logo']= $this->storeFile($request);

        Modality::create($dataForm);

        return redirect()->route('modalities.index')->withSuccess('Cadastrado com Sucesso');
    }

    public function show($id)
    {
        $modality = Modality::find($id);
        $title = 'Deletando Modalidade '.$modality->name;

        return view('admin.modality.delete', compact('title','modality'));
    }

    public function edit($id)
    {
        $modality = Modality::find($id);
        $title = 'Editando Modalidade '.$modality->nome;

        return view('admin.modality.edit', compact('title','modality'));
    }

    public function update(Request $request,$id)
    {
        $modality = Modality::find($id);
        $dataForm = $request->all();

        Storage::delete('/modalities/'.$modality->logo);
        $dataForm['logo']= $this->storeFile($request);

        $modality->update($dataForm);

        return redirect()->route('modalities.index')->withSuccess('Modalidade editada com Sucesso');
    }

    public function destroy($id)
    {
        //
    }

    public function storeFile($request){
        $full_path = 'storage/modalities/';
        File::ensureDirectoryExists($full_path);

        $nameFile = null;
        if( $request->hasFile('logo') && $request->file('logo')->isValid()) {
            $nameFile = uniqid(date('hisYmd')) . '.webp';

            $manager = new ImageManager(Driver::class);
            $image = $manager->read($request->logo);

            if ($image->width() > $image->height()) {
                $image->scale(width: 500);
            } else {
                $image->scale(height: 500);
            }
            $image->toWebp(80)->save($full_path . $nameFile);


        }
        return $nameFile;

    }
}
