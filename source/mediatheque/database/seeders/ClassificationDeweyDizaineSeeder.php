<?php

namespace Database\Seeders;

use App\Models\ClassificationDeweyCentaine;
use App\Models\ClassificationDeweyDizaine;
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
        ClassificationDeweyDizaine::create([
            'classe'=>10,
            'matiere'=>"bibliographie",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>20,
            'matiere'=>"bibliothéconomie et sciences de l'information",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>30,
            'matiere'=>"encyclopedies générales",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>40,
            'matiere'=>"non attribue",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>50,
            'matiere'=>"publication en série d'ordre general",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>60,
            'matiere'=>"organisation générales et muséologie",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>70,
            'matiere'=>"média d'information, journalisme, edition",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>80,
            'matiere'=>"receuils généraux",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>90,
            'matiere'=>"manuscrits et livre rares",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);


        // Section 100
        $classificationDeweyCentaine1 = ClassificationDeweyCentaine::all()->where('section', 100)->first();
        ClassificationDeweyDizaine::create([
            'classe'=>110,
            'matiere'=>"métaphysique",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine1->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>120,
            'matiere'=>"théorie de la connaissance, causalité, genre humain",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine1->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>130,
            'matiere'=>"phénoménes paranormaux",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine1->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>140,
            'matiere'=>"écoles philosophiques particulières",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine1->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>150,
            'matiere'=>"psycologie",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine1->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>160,
            'matiere'=>"logique",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine1->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>170,
            'matiere'=>"morale",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine1->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>180,
            'matiere'=>"philosophie ancienne, médiévale, orientale",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine1->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>190,
            'matiere'=>"philosophie occidentale moderne",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine1->id_classification_dewey_centaine
        ]);

        // Section 200
        $classificationDeweyCentaine = ClassificationDeweyCentaine::all()->where('section', 200)->first();
        ClassificationDeweyDizaine::create([
            'classe'=>210,
            'matiere'=>"philosophie et théorie de la religion",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>220,
            'matiere'=>"bible",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>230,
            'matiere'=>"christianisme théorie chrétienne",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>240,
            'matiere'=>"théologie morale et spirituelle chrétienne2",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>250,
            'matiere'=>"église locales et ordres religieux chrétiens",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>260,
            'matiere'=>"théologie chrétienne et société et eco----",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>270,
            'matiere'=>"histoire du chritianisme et de l'Eglise",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>280,
            'matiere'=>"confessions et sectes chrétiennes",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>290,
            'matiere'=>"religions comparées et autres religions",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        // Section 300
        $classificationDeweyCentaine = ClassificationDeweyCentaine::all()->where('section', 300)->first();
        ClassificationDeweyDizaine::create([
            'classe'=>310,
            'matiere'=>"statistiques générales",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>320,
            'matiere'=>"science politique",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>330,
            'matiere'=>"économie politique",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>340,
            'matiere'=>"droit",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>350,
            'matiere'=>"administration publique et science millitaire",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>360,
            'matiere'=>"problèmes et service sociaux, associations",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>370,
            'matiere'=>"éducation",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>380,
            'matiere'=>"commerce, communication, transports",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>390,
            'matiere'=>"coutumes, étiquette, f---",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        // Section 400
        $classificationDeweyCentaine = ClassificationDeweyCentaine::all()->where('section', 400)->first();
        ClassificationDeweyDizaine::create([
            'classe'=>410,
            'matiere'=>"linguistique",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>420,
            'matiere'=>"anglais et veill anglais",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>430,
            'matiere'=>"langues germaniques Allemand",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>440,
            'matiere'=>"langues romanes Français",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>450,
            'matiere'=>"italien, roumaines, méto-roma4",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>460,
            'matiere'=>"espagnol et Portugais",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>470,
            'matiere'=>"langues Italiques Latin",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>480,
            'matiere'=>"langues helléniques Grec classique",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>490,
            'matiere'=>"autre langues",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);


        // Section 500
        $classificationDeweyCentaine = ClassificationDeweyCentaine::all()->where('section', 500)->first();
        ClassificationDeweyDizaine::create([
            'classe'=>510,
            'matiere'=>"mathématiques",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>520,
            'matiere'=>"astronomie et sciences connexes",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>530,
            'matiere'=>"physique",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>540,
            'matiere'=>"chimie et sciences connexes",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>550,
            'matiere'=>"sciences de la terre",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>560,
            'matiere'=>"paléontologie plaléozoologie",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>570,
            'matiere'=>"science de la vie biologie",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>580,
            'matiere'=>"plantes",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);
        ClassificationDeweyDizaine::create([
            'classe'=>590,
            'matiere'=>"animaux",
            'id_classification_dewey_centaine'=>$classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        $classificationDeweyCentaine = ClassificationDeweyCentaine::all()->where('section', 600)->first();

        ClassificationDeweyDizaine::create([
            'classe' => 610,
            'matiere' => 'médecine',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 620,
            'matiere' => 'ingénierie',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 630,
            'matiere' => 'agriculture',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 640,
            'matiere' => 'économie domestique',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 650,
            'matiere' => 'gestion',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 660,
            'matiere' => 'chimie',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 670,
            'matiere' => 'fabrication',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 680,
            'matiere' => 'fabrication de produits',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 690,
            'matiere' => 'construction',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        $classificationDeweyCentaine = ClassificationDeweyCentaine::all()->where('section', 700)->first();

        ClassificationDeweyDizaine::create([
            'classe' => 710,
            'matiere' => 'urbanisme',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 720,
            'matiere' => 'architecture',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 730,
            'matiere' => 'sculpture, céramique, et autres arts décoratifs',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 740,
            'matiere' => 'arts graphiques et arts décoratifs',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 750,
            'matiere' => 'peinture et arts de la peinture',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 760,
            'matiere' => 'gravure et impression',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 770,
            'matiere' => 'photographie et photographies',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 780,
            'matiere' => 'musique',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 790,
            'matiere' => 'loisirs et divertissements',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        $classificationDeweyCentaine = ClassificationDeweyCentaine::all()->where('section', 800)->first();

        ClassificationDeweyDizaine::create([
            'classe' => 810,
            'matiere' => 'littérature',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 820,
            'matiere' => 'langue anglaise et littératures',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 830,
            'matiere' => 'littératures des littératures germaniques',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 840,
            'matiere' => 'littératures des littératures romanes',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 850,
            'matiere' => 'littératures italiques, littératures néo-latines',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 860,
            'matiere' => 'littératures espagnole et portugaise',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 870,
            'matiere' => 'littératures des littératures italiques',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 880,
            'matiere' => 'littératures helléniques',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 890,
            'matiere' => 'littératures des autres littératures',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        $classificationDeweyCentaine = ClassificationDeweyCentaine::all()->where('section', 900)->first();

        ClassificationDeweyDizaine::create([
            'classe' => 910,
            'matiere' => 'géographie et voyages',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 920,
            'matiere' => 'biographies et généalogie',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 930,
            'matiere' => 'histoire ancienne',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 940,
            'matiere' => 'histoire de l\'Europe',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 950,
            'matiere' => 'histoire de l\'Asie',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 960,
            'matiere' => 'histoire de l\'Afrique',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 970,
            'matiere' => 'histoire de l\'Amérique du Nord',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 980,
            'matiere' => 'histoire de l\'Amérique du Sud',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

        ClassificationDeweyDizaine::create([
            'classe' => 990,
            'matiere' => 'histoire des autres parties du monde',
            'id_classification_dewey_centaine' => $classificationDeweyCentaine->id_classification_dewey_centaine
        ]);

    }
}
