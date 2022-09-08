<script type="text/javascript" async>

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

    function removeElt(id_div_elt, id_remove_btn){
        let div_elts = document.getElementById(id_div_elt);
        let btn = event.explicitOriginalTarget;
        let remove_btn = document.getElementById(id_remove_btn);
        div_elts.removeChild(remove_btn);
        div_elts.removeChild(btn);
        stopPropagation(event);
    }

    function removeKeyWord(id_remove_btn){
        //console.log(event);
        let table_mot_cle = document.getElementById("tableMotCle");
        let div_ligne_mot_cle = table_mot_cle.children[0].children[1].children[0].children[0];
        let btn = event.explicitOriginalTarget;
        let remove_btn = document.getElementById(id_remove_btn);
        div_ligne_mot_cle.removeChild(remove_btn);
        div_ligne_mot_cle.removeChild(btn);

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
    function stopPropagation(event){
        event.preventDefault();
        event.stopPropagation();
    }
</script>
