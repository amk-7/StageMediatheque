<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificationDeweyDizaines extends Model
{
    use HasFactory;
    protected $fillable = ['classe', 'matiere', 'id_classification_dewey_centaine'];
    protected $primaryKey = 'id_classification_dewey_dizaine';

    public function classificationDeweyDizaine()
    {
        return $this->hasMany('App\Models\ClassificationDeweyDizaine', 'id_classification_dewey_dizaine');
    }
}
