<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GamesFormRequest;
use App\Models\Admin\Athlete;
use App\Models\Admin\Category;
use App\Models\Admin\Championship;
use App\Models\Admin\Club;
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

        $dataFormComplete = $this->create_game_detail($dataForm);
        $game = Game::create($dataFormComplete);

        return redirect()->route('categories.details', $game->category_id)->withSuccess('Jogo cadastrado com Sucesso');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $game = Game::find($id);
        $category = Category::find($game->category_id);
        $championship = Championship::find($game->championship_id);
        $title = 'Editando um jogo na '.$category->name.' do campeonato '.$championship->name;
        $clubs = $category->Clubs;

        return view('admin.games.edit', compact('title','category','clubs', 'game'));
    }

    public function update(Request $request, string $id)
    {
        $dataForm = $request->all();
        $game = Game::find($id);

        $game->update($dataForm);

        return redirect()->route('categories.details', $game->category_id)->withSuccess('Jogo editado com Sucesso');
    }

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
        $athletes_club_a = Functions::get_athletes($category, $game->club_a_id);
        $athletes_club_b = Functions::get_athletes($category, $game->club_b_id);
        $title = 'Detalhes de Jogos';

        return view('admin.games.details', compact('title','game', 'championship', 'category', 'referees', 'scorers', 'athletes_club_a', 'athletes_club_b'));
    }

    public function save_details(Request $request, int $id)
    {
        $game = Game::find($id);
        $dataForm = $request->all();

        $game_details = $this->update_game_detail($game, $dataForm);
        $game->update($game_details);

        $this->update_category_results($game->category_id);

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

    public function create_game_detail($dataForm){
        $athletes_json = [];
        $athletes_json[0]['athlete_id'] = null;
        $athletes_json[0]['goal'] =       null;
        $athletes_json[0]['advt'] =       null;
        $athletes_json[0]['blue'] =       null;
        $athletes_json[0]['red']  =       null;

        return [
            'category_id'               => $dataForm['category_id'],
            'championship_id'           => $dataForm['championship_id'],
            'date'                      => $dataForm['date'],
            'hour'                      => $dataForm['hour'],
            'category_game_number'      => $dataForm['category_game_number'],
            'status'                    => 0,

            'club_a_id'    => $dataForm['club_a_id'],
            'goals_a'      => 0,
            'club_b_id'    => $dataForm['club_b_id'],
            'goals_b'      => 0,

            'athlete_a_1'  => json_encode($athletes_json[0]),
            'athlete_a_2'  => json_encode($athletes_json[0]),
            'athlete_a_3'  => json_encode($athletes_json[0]),
            'athlete_a_4'  => json_encode($athletes_json[0]),
            'athlete_a_5'  => json_encode($athletes_json[0]),
            'athlete_a_6'  => json_encode($athletes_json[0]),
            'athlete_a_7'  => json_encode($athletes_json[0]),
            'athlete_a_8'  => json_encode($athletes_json[0]),
            'athlete_a_9'  => json_encode($athletes_json[0]),
            'athlete_a_10' => json_encode($athletes_json[0]),

            'athlete_b_1' => json_encode($athletes_json[0]),
            'athlete_b_2' => json_encode($athletes_json[0]),
            'athlete_b_3' => json_encode($athletes_json[0]),
            'athlete_b_4' => json_encode($athletes_json[0]),
            'athlete_b_5' => json_encode($athletes_json[0]),
            'athlete_b_6' => json_encode($athletes_json[0]),
            'athlete_b_7' => json_encode($athletes_json[0]),
            'athlete_b_8' => json_encode($athletes_json[0]),
            'athlete_b_9' => json_encode($athletes_json[0]),
            'athlete_b_10'=> json_encode($athletes_json[0]),
        ];
    }

    public function update_game_detail($game, $dataForm) {

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

        $club_win_id = null;
        $club_lost_id = null;
        if($goals_a > $goals_b){
            $club_win_id = $game->club_a_id;
            $club_lost_id = $game->club_b_id;
        } else if($goals_b > $goals_a){
            $club_win_id = $game->club_b_id;
            $club_lost_id = $game->club_a_id;
        }

        return [
            'referee_1_id'  => $dataForm['referee_1_id'],
            'referee_2_id'  => $dataForm['referee_2_id'],
            'scorer_1_id'   => $dataForm['scorer_1_id'],
            'scorer_2_id'   => $dataForm['scorer_2_id'],
            'fouls_a'       => $dataForm['fouls_a'],
            'fouls_b'       => $dataForm['fouls_b'],

            'goals_a'   => $goals_a,
            'goals_b'   => $goals_b,

            'club_win_id' => $club_win_id,
            'club_lost_id' => $club_lost_id,

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
            'athlete_b_10'=> json_encode($athletes_b[9]),

            'status' => 1
        ];


    }

    public function update_category_results($category_id) {

        //Gerando objeto com os times da categoria
        $category = Category::find($category_id);
        $clubs = $category->clubs()->get();
        $games = Game::where('category_id', $category_id)->where('status', 1)->get();

        $results = [];
        $top_scorers = [];
        foreach ($clubs as $club){
            $results[$club->id]['club_id']          = $club->id;
            $results[$club->id]['club_name']        = $club->name;
            $results[$club->id]['club_slug']        = $club->slug;
            $results[$club->id]['points']           = 0;
            $results[$club->id]['games_played']     = 0;
            $results[$club->id]['victories']        = 0;
            $results[$club->id]['draws']            = 0;
            $results[$club->id]['losts']            = 0;
            $results[$club->id]['goals_for']        = 0;
            $results[$club->id]['goals_against']    = 0;
            $results[$club->id]['goals_difference'] = 0;
        }

        foreach ($games as $game){
            if($game->club_win_id != null) {
                $results[$game->club_win_id]['points'] = $results[$game->club_win_id]['points'] + 3;
            }else{
                $results[$game->club_a_id]['points'] = $results[$game->club_a_id]['points'] + 1;
                $results[$game->club_b_id]['points'] = $results[$game->club_b_id]['points'] + 1;
            }

            $results[$game->club_a_id]['games_played']  = $results[$game->club_a_id]['games_played']+1;
            $results[$game->club_b_id]['games_played']  = $results[$game->club_b_id]['games_played']+1;


            if($game->club_win_id != null){
                $results[$game->club_win_id]['victories']   = $results[$game->club_win_id]['victories']+1;
                $results[$game->club_lost_id]['losts']       = $results[$game->club_lost_id]['losts']+1;
            } else {
                $results[$game->club_a_id]['draws']  = $results[$game->club_a_id]['draws']+1;
                $results[$game->club_b_id]['draws']  = $results[$game->club_b_id]['draws']+1;
            }

            $results[$game->club_a_id]['goals_for']         = $results[$game->club_a_id]['goals_for']+$game->goals_a;
            $results[$game->club_a_id]['goals_against']     = $results[$game->club_a_id]['goals_against']+$game->goals_b;;
            $results[$game->club_a_id]['goals_difference']  = $results[$game->club_a_id]['goals_for']-$results[$game->club_a_id]['goals_against'];

            $results[$game->club_b_id]['goals_for']         = $results[$game->club_b_id]['goals_for']+$game->goals_b;
            $results[$game->club_b_id]['goals_against']     = $results[$game->club_b_id]['goals_against']+$game->goals_a;;
            $results[$game->club_b_id]['goals_difference']  = $results[$game->club_b_id]['goals_for']-$results[$game->club_b_id]['goals_against'];

            //goals a
            for ($i = 0; $i < 10; ++$i) {
                $this_athlete = json_decode($game->{'athlete_a_'.$i+1});
                if($this_athlete->goal > 0){
                    if(isset($top_scorers[$this_athlete->athlete_id]['goals'])){
                        $top_scorers[$this_athlete->athlete_id]['goals'] = $top_scorers[$this_athlete->athlete_id]['goals']+$this_athlete->goal;
                    } else {
                        $athlete_from_db = Athlete::find($this_athlete->athlete_id);
                        $top_scorers[$this_athlete->athlete_id]['athlete_id']    = $this_athlete->athlete_id;
                        $top_scorers[$this_athlete->athlete_id]['athlete_name']  = $athlete_from_db->name;
                        $top_scorers[$this_athlete->athlete_id]['club_slug']     = $results[$game->club_a_id]['club_slug'];
                        $top_scorers[$this_athlete->athlete_id]['goals']         = $this_athlete->goal;
                    }

                }
            }
            //goals b
            for ($i = 0; $i < 10; ++$i) {
                $this_athlete = json_decode($game->{'athlete_b_'.$i+1});
                if($this_athlete->goal > 0){
                    if(isset($top_scorers[$this_athlete->athlete_id]['goals'])){
                        $top_scorers[$this_athlete->athlete_id]['goals'] = $top_scorers[$this_athlete->athlete_id]['goals']+$this_athlete->goal;
                    } else {
                        $athlete_from_db = Athlete::find($this_athlete->athlete_id);
                        $top_scorers[$this_athlete->athlete_id]['athlete_id']   = $this_athlete->athlete_id;
                        $top_scorers[$this_athlete->athlete_id]['athlete_name'] = $athlete_from_db->name;
                        $top_scorers[$this_athlete->athlete_id]['club_slug']    = $results[$game->club_b_id]['club_slug'];
                        $top_scorers[$this_athlete->athlete_id]['goals']        = $this_athlete->goal;
                    }

                }
            }

        }

        usort($results,  array($this,'sortByGoalsDiffDesc'));
        usort($results,  array($this,'sortByPointsDesc'));
        usort($top_scorers,  array($this,'sortByGoals'));

        $category->update([
            'results'       => json_encode($results),
            'top_scorers'   => json_encode($top_scorers)
        ]);

    }
    private static function sortByPointsDesc($a, $b) {
        return $b['points'] - $a['points'];
    }
    private static function sortByGoalsDiffDesc($a, $b) {
        return $b['goals_difference'] - $a['goals_difference'];
    }
    private static function sortByGoals($a, $b) {
        return $b['goals'] - $a['goals'];
    }
}
