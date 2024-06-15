<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoriesFormRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Championship;
use App\Models\Admin\Club;
use App\Models\Admin\Game;
use App\Models\Admin\Modality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $icon = 'pe-7s-albums';
        // Sharing is caring
        View::share('icon', $icon);
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($championship_id)
    {
        $championship = Championship::find($championship_id);
        $title = 'Criando uma nova categoria no Campeonato '.$championship->name;
        $modality = Modality::with('clubs')->find($championship->modality_id);
        $clubs = $modality->Clubs;

        return view('admin.categories.create', compact('title','championship','clubs'));
    }

    public function store(CategoriesFormRequest $request)
    {
        $dataForm = $request->all();

        $category = Category::create($dataForm);
        $category->clubs()->attach($dataForm['clubs']);

        return redirect()->route('categories.details', $dataForm['championship_id'])->withSuccess('Categoria cadastrada com Sucesso');
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);

        $championship = Championship::find($category->championship_id);
        $title = 'Editando a categoria '.$category->nome.' do campeonato '.$championship->name;
        $modality = Modality::with('clubs')->find($championship->modality_id);
        $clubs = $modality->Clubs;
        $category_clubs = [];
        foreach ($clubs as $club){
            array_push( $category_clubs, $club->id,);
        }

        return view('admin.categories.edit', compact('title','category', 'clubs', 'category_clubs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        $dataForm = $request->all();

        $category->update($dataForm);
        $category->clubs()->sync($dataForm['clubs']);

        return redirect()->route('championships.details', $category->championship_id)->withSuccess('Categoria editada com Sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function details($id)
    {
        $category = Category::find($id);
        $championship = Championship::find($category->championship_id);
        $title = 'Detalhes da categoria '.$category->name.' do campeonato '.$championship->name;
        $games = Game::where('category_id', $category->id)->get();

        return view('admin.categories.details', compact('title','championship', 'category', 'games'));
    }
}
