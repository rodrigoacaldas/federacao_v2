<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'logo', 'championship_id', 'age_max', 'age_min'];

    public function clubs()
    {
        return $this->belongsToMany(Club::class);
    }
}
