<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OuvrageElectronique extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'id_ouvrage'];
    protected $primaryKey = 'id_ouvrage_electronique';
}
