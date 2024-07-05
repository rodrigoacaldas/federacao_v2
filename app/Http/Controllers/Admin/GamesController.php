<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GamesFormRequest;
use App\Models\Admin\Athlete;
use App\Models\Admin\Category;
use App\Models\Admin\Championship;
use App\Models\Admin\Game;
use App\Models\Admin\GameDetail;
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
        $game_details = GameDetail::where('game_id', $id)->first();
        $championship = Championship::find($game->championship_id);
        $category = Category::find($game->category_id);
        $referees = Referee::all();
        $scorers = Scorer::all();
        $athletes_club_a = Functions::get_athetes($category, $game->club_a_id);
        $athletes_club_b = Functions::get_athetes($category, $game->club_b_id);
        $title = 'Detalhes de Jogos';
        //dd($game_details->athlete_a_1);

        return view('admin.games.details', compact('title','game', 'championship', 'category', 'referees', 'scorers', 'athletes_club_a', 'athletes_club_b', 'game_details'));
    }

    public function save_details(Request $request, int $id)
    {
        $game = Game::find($id);
        $dataForm = $request->all();

        $game_details = $this->save_game_details($game, $dataForm);
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

    public function save_game_details($game, $dataForm) {

        $athletes_a = [];
        $goals_a = 0;
        for ($i = 0; $i < 10; ++$i) {
            $athletes_a[$i]['athlete_id'] = $dataForm['athlete_a'][$i];
            $athletes_a[$i]['goal'] =       $dataForm['goals_a'][$i];
            $athletes_a[$i]['advt'] =       $dataForm['adv_a'][$i];
            $athletes_a[$i]['blue'] =       $dataForm['blue_a'][$i];
            $athletes_a[$i]['red']  =       $dataForm['red_a'][$i];
            $goals_a+=$dataForm['goals_a'][$i];
        }

        $athletes_b = [];
        $goals_b = 0;
        for ($i = 0; $i < 10; ++$i) {
            $athletes_b[$i]['athlete_id'] = $dataForm['athlete_b'][$i];
            $athletes_b[$i]['goal'] =       $dataForm['goals_b'][$i];
            $athletes_b[$i]['advt'] =       $dataForm['adv_b'][$i];
            $athletes_b[$i]['blue'] =       $dataForm['blue_b'][$i];
            $athletes_b[$i]['red']  =       $dataForm['red_b'][$i];
            $goals_b+=$dataForm['goals_b'][$i];
        }

        GameDetail::updateOrCreate(
            [ 'game_id'   => $game->id ],
            [
                'club_a_id' => $game->club_a_id,
                'goals_a'   => $goals_a,
                'club_b_id' => $game->club_b_id,
                'goals_b'   => $goals_b,

                'athlete_a_1'  => json_encode($athletes_a[0]),
                'athlete_a_2'  => json_encode($athletes_a[1]),
                'athlete_a_3'  => json_encode($athletes_a[2]),
                'athlete_a_4'  => json_encode($athletes_a[3]),
                'athlete_a_5'  => json_encode($athletes_a[4]),
                'athlete_a_6'  => json_encode($athletes_a[5]),
                'athlete_a_7'  => json_encode($athletes_a[6]),
                'athlete_a_8'  => json_encode($athletes_a[7]),
                'athlete_a_9'  => json_encode($athletes_a[8]),
                'athlete_a_10' => json_encode($athletes_a[9]),

                'athlete_b_1' => json_encode($athletes_b[0]),
                'athlete_b_2' => json_encode($athletes_b[1]),
                'athlete_b_3' => json_encode($athletes_b[2]),
                'athlete_b_4' => json_encode($athletes_b[3]),
                'athlete_b_5' => json_encode($athletes_b[4]),
                'athlete_b_6' => json_encode($athletes_b[5]),
                'athlete_b_7' => json_encode($athletes_b[6]),
                'athlete_b_8' => json_encode($athletes_b[7]),
                'athlete_b_9' => json_encode($athletes_b[8]),
                'athlete_b_10'=> json_encode($athletes_b[9])
            ]
        );

        return [
            'goals_a' => $goals_a,
            'goals_b' => $goals_b
        ];

    }
}
