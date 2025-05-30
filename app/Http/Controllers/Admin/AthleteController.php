<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AthleteFormRequest;
use App\Models\Admin\Athlete;
use App\Models\Admin\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AthleteController extends Controller
{

    public function __construct()
    {
        $icon = 'pe-7s-user icon-gradient bg-ripe-malin';
        // Sharing is caring
        View::share('icon', $icon);
    }

    public function index()
    {
        $athletes = Athlete::all();
        $title = 'Athletees';

        return view('admin.athletes.index', compact('athletes', 'title'));
    }

    public function create()
    {
        $title = 'Cadastro de Atleta';
        $clubs = Club::all();

        return view('admin.athletes.create', compact('title', 'clubs'));
    }

    public function store(AthleteFormRequest $request)
    {
        $dataFormWithFiles = $this->storeFiles($request);

        $dataFormWithFiles['birthday'] = Functions::date2sql($dataFormWithFiles['birthday']);

        $athlete = Athlete::create($dataFormWithFiles);

        return redirect()->route('athletes.index')->withSuccess('Cadastrado com Sucesso');
    }

    public function show($id)
    {
        $athlete = Athlete::find($id);
        $title = 'Deletando Athletee '.$athlete->name;

        return view('admin.athletes.delete', compact('title','athlete'));
    }

    public function edit($id)
    {
        $athlete = Athlete::find($id);
        $title = 'Editando Athletee '.$athlete->nome;
        $clubs = Club::all();


        return view('admin.athletes.edit', compact('title','athlete', 'clubs'));
    }

    public function update(AthleteFormRequest $request, $id)
    {
        $dataFormWithFiles = $this->storeFiles($request);
        $dataFormWithFiles['birthday'] = Functions::date2sql($dataFormWithFiles['birthday']);
        $athlete = Athlete::find($id);
        //dd($dataFormWithFiles);

        $athlete->update($dataFormWithFiles);

        return redirect()->route('athletes.index')->withSuccess('Editado com Sucesso');
    }

    public function destroy($id)
    {
        $athlete = Athlete::find($id);
        $delete = $athlete->delete();

        return redirect()->route('athletes.index')->withSuccess('Deletado com Sucesso');
    }

    public function storeFiles(Request $request){
        $dataForm = $request->all();

        $files = ['athlete_image', 'document_image', 'address_image', 'school_image'];

        $full_path = 'storage/athletes/';
        File::ensureDirectoryExists($full_path);

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
}
