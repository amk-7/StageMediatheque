<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tmoney extends Model
{
    use HasFactory;
    protected $fillable = ['id_registraton'];
    protected $primaryKey = 'id_tmoney';


    public function registration()
    {
        return $this->belongsTo('App\Models\Registration', 'id_registraton');
    }
}
