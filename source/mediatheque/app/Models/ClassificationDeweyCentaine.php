<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificationDeweyCentaine extends Model
{
    use HasFactory;
    protected $fillable = ['section', 'theme'];
    protected $primaryKey = 'id_classification_dewey_centaine';
}
