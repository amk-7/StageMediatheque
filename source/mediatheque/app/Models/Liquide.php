<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquide extends Model
{
    use HasFactory;
    protected $fillable = ['id_registration'];
    protected $primaryKey = 'id_liquide';


    public function registration()
    {
        return $this->belongsTo('App\Models\Registration', 'id_liquide');
    }
}
