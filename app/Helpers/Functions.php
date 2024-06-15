<?php

namespace App\Helpers;

use App\Models\Admin\Athlete;
use App\Models\Admin\GameDetail;
use App\Models\Event;
use App\Models\Goal;
use App\Models\IncomingPayment;
use Carbon\Carbon;

class Functions
{
    public static function date2sql($date){
        return implode("-", array_reverse(explode("/", $date)));
    }

    public static function hour2sql($hour){
        return str_replace('_', '0', $hour);
    }

    public static function datetime2sql($date){
        // converte data com formato dd/mm/yyyy hh:mm para o formato yyyy-mm-dd hh:mm
        return Carbon::createFromFormat('d/m/Y H:i', $date)->format('Y-m-d H:i');
    }


    public static function getDateComplete($date, $month = 1){
        // pega a data completa do dia $date para o mes atual + month
        $now = new Carbon();

        $newData = Carbon::createFromDate($now->year, $now->addMonth($month)->month, $date);

        return $newData;
    }

    public static function getEmailText($emailText, $budget){

        $variables = array('%NOME%', '%DATA%', '%HORA%');

        $originals   = array($budget->client->name, date('d/m/Y', strtotime($budget->date_time)), date('H:i', strtotime($budget->date_time)));

        return str_replace($variables, $originals, $emailText);
    }

    public static function ajustMoneyField($value){

        $newValue = str_replace('r$ ', '', $value);
        $newValue = str_replace('.', '', $newValue);
        $newValue = str_replace(',', '.', $newValue);

        return $newValue;
    }

    public static function get_athetes($category, $club_id){

        $age_max = null;
        if($category->age_max){
            $age_max = Carbon::now()->subYear($category->age_max)->startOfYear();
        }

        $age_min = null;
        if($category->age_min){
            $age_min = Carbon::now()->subYear($category->age_min)->startOfYear();
        }

        $athetes = Athlete::where('club_id', $club_id)
            ->when($age_max, function ($query) use ($age_max) {
                return $query->where('birthday', '>', $age_max);
            })
            ->when($age_min, function ($query) use ($age_min) {
                return $query->where('birthday', '<', $age_min);
            });

        return $athetes->get();
    }


    public static function save_game_details($game, $dataForm) {

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
