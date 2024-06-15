<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChampionshipFormRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Championship;
use App\Models\Admin\Modality;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ChampionshipController extends Controller
{
    public function __construct()
    {
        $icon = 'pe-7s-medal icon-gradient bg-ripe-malin';
        // Sharing is caring
        View::share('icon', $icon);
    }
    public function index()
    {
        $championships = Championship::all();
        $title = 'Campeonatos';

        return view('admin.championships.index', compact('championships', 'title'));
    }

    public function create()
    {
        $title = 'Cadastro de Campeonato';
        $modalities = Modality::all();

        return view('admin.championships.create', compact('title', 'modalities'));
    }

    public function store(ChampionshipFormRequest $request)
    {
        $dataFormWithFiles = $this->storeFiles($request);

        Championship::create($dataFormWithFiles);

        return redirect()->route('championships.index')->withSuccess('Cadastrado com Sucesso');
    }

    public function show($id)
    {
        $championship = Championship::find($id);
        $title = 'Deletando Campeonato '.$championship->name;
        $modalities = Modality::all();

        return view('admin.championships.delete', compact('title','championship'));
    }

    public function edit($id)
    {
        $championship = Championship::find($id);
        $title = 'Editando Campeonato '.$championship->nome;
        $modalities = Modality::all();

        return view('admin.championships.edit', compact('title','championship', 'modalities'));
    }

    public function update(ChampionshipFormRequest $request,$id)
    {
        $championship = Championship::find($id);

        $dataFormWithFiles = $this->storeFiles($request);

        $championship->update($dataFormWithFiles);

        return redirect()->route('championships.index')->withSuccess('Modalidade editada com Sucesso');
    }

    public function destroy($id)
    {
        //
    }

    public function storeFiles($request){
        $dataForm = $request->all();

        $full_path = 'storage/championships/';
        File::ensureDirectoryExists($full_path);

        $files = ['logo', 'header_image'];

        foreach ($files as $file){
            if( $request->hasFile($file) && $request->file($file)->isValid()){

                $nameFile = uniqid(date('hisYmd')).'.webp';

                $manager = new ImageManager(Driver::class);
                $image = $manager->read($request->$file);

                if($image->width() > $image->height()){
                    $image->scale(width: 500);
                } else {
                    $image->scale(height: 500);
                }
                $image->toWebp(80)->save($full_path.$nameFile);

                $dataForm["$file"] = $nameFile;
            }
        }

        return $dataForm;

    }

    public function details($id)
    {
        $championship = Championship::find($id);
        $categories = Category::where('championship_id', $id)->get();
        $title = 'Detalhes do Campeonato '.$championship->name;

        return view('admin.championships.details', compact('title','championship', 'categories'));
    }
}
