<?php

namespace Database\Seeders;

use App\Models\ClassificationDeweyCentaine;
use App\Models\ClassificationDeweyDizaines;
use Illuminate\Database\Seeder;

class ClassificationDeweyDizaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Section 0
        $classificationDeweyCentaine = ClassificationDeweyCentaine::all()->where('section', 0)->first();
        ClassificationDeweyDizaines::create([
            'classe'=>10,
            'matiere'=>"bibliographie",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>20,
            'matiere'=>"bibliothéconomie et sciences de l'information",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>30,
            'matiere'=>"encyclopédies générales",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>40,
            'matiere'=>"non attribué",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>50,
            'matiere'=>"publication en série d'ordre général",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>60,
            'matiere'=>"organisation générales et muséologie",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>70,
            'matiere'=>"media d'information, journalisme, edition",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>80,
            'matiere'=>"receuils généraux",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>90,
            'matiere'=>"manuscrits et livre rares",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);


        // Section 100
        $classificationDeweyCentaine = ClassificationDeweyCentaine::all()->where('section', 100)->first();
        ClassificationDeweyDizaines::create([
            'classe'=>110,
            'matiere'=>"métaphysique",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>120,
            'matiere'=>"théorie de la connaissance, causalité, genre humain",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>130,
            'matiere'=>"phénoménes paranormaux",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>140,
            'matiere'=>"écoles philosophiques particulières",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>150,
            'matiere'=>"psycologie",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>160,
            'matiere'=>"logique",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>170,
            'matiere'=>"morale",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>180,
            'matiere'=>"philosophie ancienne, médiévale, orientale",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>190,
            'matiere'=>"philosophie occidentale moderne",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        // Section 200
        $classificationDeweyCentaine = ClassificationDeweyCentaine::all()->where('section', 200)->first();
        ClassificationDeweyDizaines::create([
            'classe'=>210,
            'matiere'=>"philosophie et théorie de la religion",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>220,
            'matiere'=>"bible",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>230,
            'matiere'=>"christianisme théorie chrétienne",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>240,
            'matiere'=>"théologie morale et spirituelle chrétienne2",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>250,
            'matiere'=>"église locales et ordres religieux chrétiens",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>260,
            'matiere'=>"théologie chrétienne et société et eco----",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>270,
            'matiere'=>"histoire du chritianisme et de l'Eglise",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>280,
            'matiere'=>"confessions et sectes chrétiennes",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>290,
            'matiere'=>"religions comparées et autres religions",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        // Section 300
        $classificationDeweyCentaine = ClassificationDeweyCentaine::all()->where('section', 300)->first();
        ClassificationDeweyDizaines::create([
            'classe'=>310,
            'matiere'=>"statistiques générales",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>320,
            'matiere'=>"science politique",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>330,
            'matiere'=>"économie politique",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>340,
            'matiere'=>"droit",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>350,
            'matiere'=>"administration publique et science millitaire",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>360,
            'matiere'=>"problèmes et service sociaux, associations",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>370,
            'matiere'=>"éducation",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>380,
            'matiere'=>"commerce, communication, transports",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>390,
            'matiere'=>"coutumes, étiquette, f---",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        // Section 400
        $classificationDeweyCentaine = ClassificationDeweyCentaine::all()->where('section', 400)->first();
        ClassificationDeweyDizaines::create([
            'classe'=>410,
            'matiere'=>"linguistique",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>420,
            'matiere'=>"anglais et veill anglais",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>430,
            'matiere'=>"langues germaniques Allemand",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>440,
            'matiere'=>"langues romanes Français",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>450,
            'matiere'=>"italien, roumaines, méto-roma4",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>460,
            'matiere'=>"espagnol et Portugais",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>470,
            'matiere'=>"langues Italiques Latin",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>480,
            'matiere'=>"langues helléniques Grec classique",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaines::create([
            'classe'=>490,
            'matiere'=>"autre langues",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

    }
}
