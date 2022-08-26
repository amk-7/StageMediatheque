<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificationDeweyDizaine extends Model
{
    use HasFactory;
    protected $fillable = ['classe', 'matiere', 'id_classification_dewey_centaine'];
    protected $primaryKey = 'id_classification_dewey_dizaine';

    public function ouvragePhysqiques(){
        return $this->hasMany(OuvragesPhysique::class, "id_classification_dewey_dizaine");
    }

    public function classificationDeweyCentaine(){
        return $this->belongsTo(ClassificationDeweyCentaine::class, "id_classification_dewey_dizaine");
    }
}
