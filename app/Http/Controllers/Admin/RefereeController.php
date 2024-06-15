<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RefereeFormRequest;
use Illuminate\Http\Request;

use App\Models\Admin\Referee;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class RefereeController extends Controller
{
    public function __construct()
    {
        $icon = 'pe-7s-user icon-gradient bg-ripe-malin';
        // Sharing is caring
        View::share('icon', $icon);
    }

    public function index()
    {
        $referees = Referee::all();
        $title = 'Arbitros';

        return view('admin.referees.index', compact('referees', 'title'));
    }

    public function create()
    {
        $title = 'Cadastro de Árbitro';

        return view('admin.referees.create', compact('title'));
    }

    public function store(RefereeFormRequest $request)
    {
        $dataFormWithFiles = $this->storeFiles($request);
        Referee::create($dataFormWithFiles);

        return redirect()->route('referees.index')->withSuccess('Cadastrado com Sucesso');
    }

    public function show($id)
    {
        $referee = Referee::find($id);
        $title = 'Deletando Árbitro '.$referee->name;

        return view('admin.referees.delete', compact('title','referee'));
    }

    public function edit($id)
    {
        $referee = Referee::find($id);
        $title = 'Editando Árbitro '.$referee->nome;

        return view('admin.referees.edit', compact('title','referee'));
    }

    public function update(RefereeFormRequest $request, $id)
    {
        $dataFormWithFiles = $this->storeFiles($request);

        $referee = Referee::find($id);
        $referee->update($dataFormWithFiles);

        return redirect()->route('referees.index')->withSuccess('Editado com Sucesso');
    }

    public function destroy($id)
    {
        $referee = Referee::find($id);
        $referee->delete();

        return redirect()->route('referees.index')->withSuccess('Deletado com Sucesso');
    }

    public function storeFiles(Request $request){
        $dataForm = $request->all();
        $dataForm['birthday'] = Functions::date2sql($dataForm['birthday']);

        $files = ['image'];

        $full_path = 'storage/referees/';
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
