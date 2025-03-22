<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClubFormRequest;
use App\Models\Admin\Club;
use App\Models\Admin\Modality;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ClubController extends Controller
{

    public function __construct()
    {
        $icon = 'pe-7s-flag icon-gradient bg-ripe-malin';
        $modalities = Modality::all();
        // Sharing is caring
        View::share('icon', $icon);
    }

    public function index()
    {
        $clubs = Club::all();
        $title = 'Clubes';

        return view('admin.clubs.index', compact('clubs', 'title'));
    }

    public function create()
    {
        $title = 'Cadastro de Clube';
        $modalities = Modality::all();

        return view('admin.clubs.create', compact('title', 'modalities'));
    }

    public function store(ClubFormRequest $request)
    {
        $dataForm = $request->all();

        $dataForm['image']= $this->storeFile($request);

        $club = Club::create($dataForm);
        $club->modalities()->attach($dataForm['modalities']);

        return redirect()->route('clubs.index')->withSuccess('Cadastrado com Sucesso');
    }

    public function show($id)
    {
        $club = Club::find($id);
        $title = 'Deletando Clube '.$club->name;
        $modalities = Modality::all();

        return view('admin.clubs.delete', compact('title','club', 'modalities'));
    }

    public function edit($id)
    {
        $club = Club::with('modalities')->find($id);
        $title = 'Editando Clube '.$club->nome;
        $modalities = Modality::all();
        $club_modalities = [];
        foreach ($club->modalities as $modality){
            array_push( $club_modalities, $modality->id,);
        }

        return view('admin.clubs.edit', compact('title','club', 'modalities', 'club_modalities'));
    }

    public function update(ClubFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $club = Club::find($id);

        if(isset($dataForm['image'])){
            Storage::delete('/clubs/'.$club->image);
            $dataForm['image']= $this->storeFile($request);
        }
        $club->update($dataForm);
        $club->modalities()->sync($dataForm['modalities']);

        return redirect()->route('clubs.index')->withSuccess('Editado com Sucesso');
    }

    public function destroy($id)
    {
        $club = Club::find($id);
        $delete = $club->delete();

        return redirect()->route('clubs.index')->withSuccess('Deletado com Sucesso');
    }

    public function storeFile($request){
        $full_path = 'storage/clubs/';
        File::ensureDirectoryExists($full_path);

        $nameFile = null;
        if( $request->hasFile('image') && $request->file('image')->isValid()) {
            $nameFile = uniqid(date('hisYmd')) . '.webp';

            $manager = new ImageManager(Driver::class);
            $image = $manager->read($request->image);

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
