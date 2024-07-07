<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modality extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'logo', 'description' , 'header_image', 'phone', 'email'];

    public function clubs()
    {
        return $this->belongsToMany(Club::class);
    }
}
