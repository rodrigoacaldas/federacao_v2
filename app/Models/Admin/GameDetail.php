<?php

namespace App\Models\Admin;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['game_id', 'club_a_id', 'club_b_id',
        'athlete_a_1',  'athlete_a_2', 'athlete_a_3', 'athlete_a_4', 'athlete_a_5',
        'athlete_a_6', 'athlete_a_7', 'athlete_a_8', 'athlete_a_9', 'athlete_a_10',
        'athlete_b_1',  'athlete_b_2', 'athlete_b_3', 'athlete_b_4', 'athlete_b_5',
        'athlete_b_6', 'athlete_b_7', 'athlete_b_8', 'athlete_b_9', 'athlete_b_10',
        ];

    public function game()
    {
        return $this->belongsTo(Game::class);
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
