<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scorer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name','birthday','cpf','email','address','neighborhood','cep','phone1','phone2', 'image'];

    public function modalities()
    {
        return $this->belongsToMany(Modality::class);
    }

    public function games()
    {
        return $this->HasMany(Game::class);
    }
}
