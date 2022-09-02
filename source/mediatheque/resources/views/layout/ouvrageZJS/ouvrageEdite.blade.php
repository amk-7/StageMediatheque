<script type="text/javascript" async>

    let selectRayon = document.getElementById("id_classification_dewey_centaine");
    let selectEtagere = document.getElementById("id_classification_dewey_dizaine");

    const rayon_selected_value = "{!! $livresPapier->ouvragePhysique->classificationDeweyDizaine->classificationDeweyCentaine->first()->theme !!}";
    const etager_selected_value = "{!! $livresPapier->ouvragePhysique->classificationDeweyDizaine->id_classification_dewey_dizaine !!}";

    console.log(rayon_selected_value);
    // Mettre à jour le rayon et l'étagère.
    for (let i=0; i<selectRayon.options.length; i++){
        //console.log(selectRayon.options[i].innerText);
        if (selectRayon.options[i].innerText == rayon_selected_value){
            // Mettre à jour le rayon.
            selectRayon.selectedIndex = selectRayon.options[i].index;
            let json_etager = JSON.parse(sessionStorage.getItem("liste_etagers"));
            for (let j = 0; j < json_etager.length ; j++) {

                if (selectRayon.options[i].value == json_etager[j].id_classification_dewey_centaine ){
                    let option = document.createElement("option");
                    option.value = json_etager[j].id_classification_dewey_dizaine;
                    option.innerText = json_etager[j].matiere;
                    selectEtagere.appendChild(option);
                    if (selectEtagere.options[j].value == etager_selected_value){
                        // Mettre à jour le rayon l'étagère.
                        selectEtagere.selectedIndex = selectEtagere.options[j].index;
                    }
                }
            }
        }
    }
    // Mettre les données de l'ouvrage.
    // Mettre le niveau.
    let niveau = "{!! $livresPapier->ouvragePhysique->ouvrage->niveau !!}";
    let type = "{!! $livresPapier->ouvragePhysique->ouvrage->type  !!}";
    let langue = "{!! $livresPapier->ouvragePhysique->ouvrage->langue !!}";
    let disponibilite = "{!! $livresPapier->ouvragePhysique->disponibilite !!}";


    if (disponibilite==""){
        disponibilite = "0"
    }
    //console.log(etat)
    let annee_apparution = "{!! $livresPapier->ouvragePhysique->ouvrage->auteurs->first()->pivot->annee_apparution  !!}";

    //console.log(langue);
    selectionnerValeur("niveau", niveau);
    // Mettre le type.
    selectionnerValeur("type", type);
    // Mettre la langue.
    selectionnerValeur("langue", langue);

    // Mettre l'etat.
    selectionnerValeur("etat", etat);
    // Mettre l'annee d'apparution.
    selectionnerValeur("annee_apparution", annee_apparution);

    selectionnerValeur("disponibilite", disponibilite);

    function selectionnerValeur(id_balise_select, valeur){
        let select_attribute = document.getElementById(`${id_balise_select}`);
        let select_attribute_values = select_attribute.options;
        //console.log(valeur);
        // enlever les espace avant la comparaison
        for (let i = 0; i < select_attribute_values.length; i++) {
            if(select_attribute_values[i].value==valeur){
                select_attribute.selectedIndex = select_attribute.options[i].index;
            }
        }
    }

    function removeKeyWord(id_remove_btn){
        //console.log(event);
        let table_mot_cle = document.getElementById("tableMotCle");
        let div_ligne_mot_cle = table_mot_cle.children[0].children[1].children[0].children[0];
        let btn = event.explicitOriginalTarget;
        let remove_btn = document.getElementById(id_remove_btn);
        div_ligne_mot_cle.removeChild(remove_btn);
        div_ligne_mot_cle.removeChild(btn);
        event.preventDefault();
        event.stopPropagation();
    };

    function removeAuteur(id_remove_btn){
        let div_auteurs = document.getElementById("listeAuteurs");
        let btn = event.explicitOriginalTarget;
        let removeBtn = document.getElementById(id_remove_btn);
        div_auteurs.removeChild(removeBtn);
        div_auteurs.removeChild(btn);
        event.preventDefault();
        event.stopPropagation();
    }

    function removeCategorie(id_remove_btn){

        event.preventDefault();
        event.stopPropagation();
        let div_categorie = document.getElementById("listeCategorie");
        let btn = event.explicitOriginalTarget;
        let remove_btn = document.getElementById(id_remove_btn);
        console.log(remove_btn);
        div_categorie.removeChild(remove_btn);
        div_categorie.removeChild(btn);
    }

</script>
