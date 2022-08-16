<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flooz extends Model
{
    use HasFactory;
    protected $fillable = ['id_registraton'];
    protected $primaryKey = 'id_flooz';


    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
