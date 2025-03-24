<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Championship;
use App\Models\Admin\Game;
use App\Models\Admin\Modality;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Helpers\Matches;

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

        $next_matches = Matches::get_next_matches();

        $last_matches = Matches::get_last_matches();

        return view('site.home', compact('title', 'next_matches', 'last_matches'));
    }

    public function championship_details($id)
    {
        $championship = Championship::find($id);
        $title = 'Detalhes do Campeonato '.$championship->name;
        $categories = Category::where('championship_id', $id)->get();

        $next_matches = Matches::get_next_matches($id);

        $last_matches = Matches::get_last_matches($id);

        $meta_description = 'Campeonato '.$championship->name;
        $meta_image = $championship->image;
        $meta_url = url()->current();

        return view('site.championship_details', compact('title', 'championship','categories','next_matches', 'last_matches',
            'meta_description', 'meta_image', 'meta_url'));
    }

    public function modality_details($id)
    {
        $modality = Modality::find($id);
        $title = 'Detalhes da modalidade '.$modality->name;


        return view('site.modality_details', compact('title', 'modality'));
    }
    
    public function contact()
    {
        $title = 'Entre em contato com a gente!';
        $modalities = Modality::all();
        return view('site.contact', compact('title', 'modalities'));
    }

    public function championship_category_all_games($championship_id, $category_id)
    {
        $championship = Championship::find($championship_id);
        $category = Category::find($category_id);

        $title = 'Campeonato: '.$championship->name;
        $title2 = 'Todos os jogos da categoria '.$category->name;

        $next_matches = Matches::get_next_matches($championship_id, 0, $category_id);
        $last_matches = Matches::get_last_matches($championship_id, 0, $category_id);
        $all_games = true;

        return view('site.championship_category_all_matches', compact('title', 'title2', 'championship','category', 'next_matches', 'last_matches', 'all_games'));
    }

    public function championship_category_statistcs()
    {
        $title = 'Entre em contato com a gente!';
        $modalities = Modality::all();
        return view('site.contact', compact('title', 'modalities'));
    }

    
}
