<?php

namespace App\Models\Admin;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'championship_id', 'category_id', 'date', 'hour', 'status', 'category_game_number',
        'club_a_id', 'club_b_id', 'goals_a', 'goals_b', 'fouls_a', 'fouls_b',
        'referee_1_id', 'referee_2_id', 'scorer_1_id', 'scorer_2_id',
        'club_win_id', 'club_lost_id',
        'athlete_a_1',  'athlete_a_2', 'athlete_a_3', 'athlete_a_4', 'athlete_a_5',
        'athlete_a_6', 'athlete_a_7', 'athlete_a_8', 'athlete_a_9', 'athlete_a_10',
        'athlete_b_1',  'athlete_b_2', 'athlete_b_3', 'athlete_b_4', 'athlete_b_5',
        'athlete_b_6', 'athlete_b_7', 'athlete_b_8', 'athlete_b_9', 'athlete_b_10',
];

    public function modalities()
    {
        return $this->belongsToMany(Modality::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    //Mutator & Accessor
    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('d/m/Y', strtotime($value)),
            set: fn ($value) => Functions::date2sql($value),
        );
    }

    protected function hour(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date( 'H:i' , strtotime($value)),
            set: fn ($value) => Functions::hour2sql($value),
        );
    }

    public function club_a()
    {
        return $this->belongsTo(Club::class, 'club_a_id');
    }

    public function club_b()
    {
        return $this->belongsTo(Club::class, 'club_b_id');
    }

    public function scopeJoins($query)
    {
        return $query->join('categories', 'categories.id', 'games.category_id')
            ->join('clubs as club_a', 'club_a.id', 'games.club_a_id')
            ->join('clubs as club_b', 'club_b.id', 'games.club_b_id')
            ->join('championships', 'championships.id', 'games.championship_id')
            ->join('modalities', 'modalities.id', 'championships.modality_id')
            ->select('games.*', 'categories.name as category_name','modalities.name as modality_name',
                'championships.name as championship_name','championships.header_image as championship_image',
                'club_a.name as club_a_name', 'club_a.image as club_a_image','club_a.slug as club_a_slug',
                'club_b.name as club_b_name', 'club_b.image as club_b_image', 'club_b.slug as club_b_slug')
            ->distinct();
    }
}
