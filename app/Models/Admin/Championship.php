<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Championship extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $fillable = ['name','slug', 'logo', 'header_image', 'modality_id','status'];

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }
}
