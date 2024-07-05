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

    protected $fillable = ['championship_id', 'category_id', 'club_a_id', 'club_b_id', 'date', 'hour',
        'had_finish',
        'goals_a', 'goals_b', 'fouls_a', 'fouls_b',
        'referee_1_id', 'referee_2_id', 'scorer_1_id', 'scorer_2_id',
        'category_game_number'];

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
}
