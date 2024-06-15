<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ScorerFormRequest;
use App\Models\Admin\Scorer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ScorerController extends Controller
{
    public function __construct()
    {
        $icon = 'pe-7s-user icon-gradient bg-ripe-malin';
        // Sharing is caring
        View::share('icon', $icon);
    }

    public function index()
    {
        $scorers = Scorer::all();
        $title = 'Mesários';

        return view('admin.scorers.index', compact('scorers', 'title'));
    }

    public function create()
    {
        $title = 'Cadastro de Mesário';

        return view('admin.scorers.create', compact('title'));
    }

    public function store(ScorerFormRequest $request)
    {
        $dataFormWithFiles = $this->storeFiles($request);
        Scorer::create($dataFormWithFiles);

        return redirect()->route('scorers.index')->withSuccess('Cadastrado com Sucesso');
    }

    public function show($id)
    {
        $scorer = Scorer::find($id);
        $title = 'Deletando Mesário '.$scorer->name;

        return view('admin.scorers.delete', compact('title','scorer'));
    }

    public function edit($id)
    {
        $scorer = Scorer::find($id);
        $title = 'Editando Mesário '.$scorer->nome;

        return view('admin.scorers.edit', compact('title','scorer'));
    }

    public function update(ScorerFormRequest $request, $id)
    {
        $dataFormWithFiles = $this->storeFiles($request);

        $scorer = Scorer::find($id);
        $scorer->update($dataFormWithFiles);

        return redirect()->route('scorers.index')->withSuccess('Editado com Sucesso');
    }

    public function destroy($id)
    {
        $scorer = Scorer::find($id);
        $scorer->delete();

        return redirect()->route('scorers.index')->withSuccess('Deletado com Sucesso');
    }

    public function storeFiles(Request $request){
        $dataForm = $request->all();
        $dataForm['birthday'] = Functions::date2sql($dataForm['birthday']);

        $files = ['image'];

        $full_path = 'storage/scorers/';
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
