<?php

namespace App\Models\Admin;

use App\Modality\ModalityTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'name', 'image'];

    public function modalities()
    {
        return $this->belongsToMany(Modality::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function games(){
        return $this->hasMany(Game::class);
    }


}
