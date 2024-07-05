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





}
