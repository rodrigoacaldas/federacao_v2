<?php

namespace App\Helpers;

use App\Models\Admin\Game;

use Carbon\Carbon;

class Matches
{
    public static function get_next_matches($championship_id = null, $limit = 2, $category_id = null){
        return Game::joins()
            ->where('games.date','>',Carbon::now())
            ->when($championship_id, function ($query) use ($championship_id) {
                return $query->where('games.championship_id', $championship_id);
            })
            ->when($category_id, function ($query) use ($category_id) {
                return $query->where('games.category_id', $category_id);
            })           
            ->orderBy('games.date', 'asc')
            ->orderBy('games.hour', 'asc')
            ->when($limit != 0, function ($query) use ($limit) {
                return $query->limit($limit);
            })
            ->get();
    }

    public static function get_last_matches($championship_id = null, $limit = 2, $category_id = null){
        return Game::joins()
            ->where('games.status','1')
            ->when($championship_id, function ($query) use ($championship_id) {
                return $query->where('games.championship_id', $championship_id);
            })            
            ->when($category_id, function ($query) use ($category_id) {
                return $query->where('games.category_id', $category_id);
            })            
            ->orderBy('games.date', 'desc')
            ->orderBy('games.hour', 'asc')
            ->when($limit != 0, function ($query) use ($limit) {
                return $query->limit($limit);
            })
            ->get();
    }


}
