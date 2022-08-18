<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OuvragesParRestitution extends Model
{
    use HasFactory;
    protected $fillable = ['etat_ouvrage'];
    protected $primaryKey = ['id_restitution', 'id_ouvrage_physique'];
}
