<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificationDeweyDizaines extends Model
{
    use HasFactory;
    protected $fillable = ['classe', 'matiere', 'id_classification_dewey_centaine'];
    protected $primaryKey = 'id_classification_dewey_dizaine';

    public function ouvragePhysqique(){
        return $this->hasMany(OuvragePhysique::class);
<<<<<<< HEAD
    }

    public function classificationDeweyCentaine(){
        return $this->hasOne(ClassificationDeweyCentaine::class);
    }
=======
>>>>>>> b696e0691e623699863b2d12c204598fd578fdb1
}
