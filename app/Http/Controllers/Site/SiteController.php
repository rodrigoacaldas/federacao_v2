<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Championship;
use App\Models\Admin\Game;
use App\Models\Admin\Modality;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class SiteController extends Controller
{
    public function __construct()
    {
        $icon = 'pe-7s-user icon-gradient bg-ripe-malin';
        $modalities = Modality::all();
        $championships = Championship::all();

        // Sharing is caring
        View::share( [
            'modalities'    => $modalities,
            'championships' => $championships
        ] );
    }

    public function index()
    {
        $title = 'Homepage';

        $next_match = Game::joins()
            ->where('date','>',Carbon::now())
            ->orderBy('date', 'desc')
            ->orderBy('hour', 'asc')
            ->first();

        $last_matches = Game::joins()
            ->where('games.status','1')
            ->orderBy('date', 'desc')
            ->orderBy('hour', 'asc')
            ->get();

        return view('site.home', compact('title', 'next_match', 'last_matches'));
    }

    public function championship_details($id)
    {
        $championship = Championship::find($id);
        $title = 'Detalhes do Campeonato '.$championship->name;
        $categories = Category::where('championship_id', $id)->get();

        $next_match = Game::joins()
            ->where('date','>',Carbon::now())
            ->where('games.championship_id', $id)
            ->orderBy('date', 'desc')
            ->orderBy('hour', 'asc')
            ->first();

        $last_matches = Game::joins()
            ->where('games.status','1')
            ->where('games.championship_id', $id)
            ->orderBy('date', 'desc')
            ->orderBy('hour', 'asc')
            ->get();

        return view('site.championship_details', compact('title', 'championship','categories','next_match', 'last_matches'));
    }

    public function modality_details($id)
    {
        $modality = Modality::find($id);
        $title = 'Detalhes da modalidade '.$modality->name;


        return view('site.modality_details', compact('title', 'modality'));
    }
}
