<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GamesFormRequest;
use App\Models\Admin\Athlete;
use App\Models\Admin\Category;
use App\Models\Admin\Championship;
use App\Models\Admin\Game;
use App\Models\Admin\Referee;
use App\Models\Admin\Scorer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class GamesController extends Controller
{
    public function __construct()
    {
        $icon = 'pe-7s-ball';
        // Sharing is caring
        View::share('icon', $icon);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($category_id)
    {
        $category = Category::find($category_id);
        $title = 'Criando um novo jogo na categoria '.$category->name;
        $clubs = $category->Clubs;

        return view('admin.games.create', compact('title','category','clubs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GamesFormRequest $request)
    {
        $dataForm = $request->all();

        if(!$dataForm['category_game_number']){
            $dataForm['category_game_number'] = $this->getNextGameNumber($dataForm['category_id']);
        }

        Game::create($dataForm);

        return redirect()->route('categories.details', $dataForm['championship_id'])->withSuccess('Jogo cadastrado com Sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $game = Game::find($id);
        $category = Category::find($game->category_id);
        $championship = Championship::find($game->championship_id);
        $title = 'Editando um jogo na '.$category->name.' do campeonato '.$championship->name;
        $clubs = $category->Clubs;

        return view('admin.games.edit', compact('title','category','clubs', 'game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataForm = $request->all();
        $game = Game::find($id);

        $game->update($dataForm);

        return redirect()->route('categories.details', $dataForm['championship_id'])->withSuccess('Jogo editado com Sucesso');
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
        $game = Game::find($id);
        $championship = Championship::find($game->championship_id);
        $category = Category::find($game->category_id);
        $referees = Referee::all();
        $scorers = Scorer::all();
        $athletes_club_a = Functions::get_athetes($category, $game->club_a_id);
        $athletes_club_b = Functions::get_athetes($category, $game->club_b_id);
        $title = 'Detalhes de Jogos';

        return view('admin.games.details', compact('title','game', 'championship', 'category', 'referees', 'scorers', 'athletes_club_a', 'athletes_club_b'));
    }

    public function save_details(Request $request, int $id)
    {
        $game = Game::find($id);
        $dataForm = $request->all();

        $game_details = Functions::save_game_details($game, $dataForm);
        $game->update([
            'status'        => 1,
            'referee_1_id'  => $dataForm['referee_1_id'],
            'referee_2_id'  => $dataForm['referee_2_id'],
            'scorer_1_id'   => $dataForm['scorer_1_id'],
            'scorer_2_id'   => $dataForm['scorer_2_id'],
            'goals_a'       => $game_details['goals_a'],
            'goals_b'       => $game_details['goals_b'],
            'fouls_a'       => $dataForm['fouls_a'],
            'fouls_b'       => $dataForm['fouls_b'],
        ]);

        return redirect()->route('categories.details', $dataForm['category_id']);
    }

    public function ajustGameNumber($game){

        $exist = DB::table($table)->where($table.'.order', '=', $order)
            ->when($table == 'menu_items', function ($query) use ($whereID) {
                return $query->where('menu_subcategory_id', $whereID);
            })
            ->when($table == 'menu_subcategories', function ($query) use ($whereID) {
                return $query->where('menu_category_id', $whereID);
            })
            ->where('deleted_at', '=', null)
            ->first();

        if ($exist){
            $objects = DB::table($table)->where($table.'.order', '>=', $order)
                ->when($table == 'menu_items', function ($query) use ($whereID) {
                    return $query->where('menu_subcategory_id', $whereID);
                })
                ->when($table == 'menu_subcategories', function ($query) use ($whereID) {
                    return $query->where('menu_category_id', $whereID);
                })
                ->orderBy('order')
                ->get();

            if (count($objects) > 0){
                $lastOrder = $order;
                foreach ($objects as $object){
                    if($object->order >= $lastOrder+1){
                        break;
                    } else{
                        $update = DB::table($table)
                            ->where('id', $object->id)
                            ->update(['order' => $object->order + 1]);
                        $lastOrder = $object->order+1;
                    }
                }
            }
        }

        return true;
    }

    public function getNextGameNumber($category_id){
        $games = Game::where('category_id', $category_id)->get();
        return count($games)+1;
    }
}
