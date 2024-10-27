<script type="text/javascript" async>
    //console.log("Ok");

    let id_oject = 0;
    //============== Initialisation des composant ====================
    const addAuteurBtn = document.getElementById("ajouter_auteur");
    const addkeyWord = document.getElementById("ajouter_mot_cle");
    const addRessource = document.getElementById("ajouter_ressource");
    const inputSave = document.getElementById("enregistrer");

    //============== Ajout des event listener ========================

    function setData(input_data, div_liste_data){
        const div_liste_data_chilidren = div_liste_data.children;
        console.log(div_liste_data_chilidren);
        for(let i=0; i<div_liste_data_chilidren.length; i++){
            const children = div_liste_data_chilidren[i].children;
            for(let j=0; j<children.length; j++){
                if (children[j].type==="text"){
                    input_data.value += `${children[j].value};`;
                }
            }
        }
    }

    inputSave.addEventListener('click', function addDataBeforeSend(e){

        //stoperPropagation(e);

        const auteur_data = document.getElementById('data_auteurs');
        const mots_cle_data = document.getElementById('data_mots_cle');
        const ressources_externe_data = document.getElementById('ressources_externe');

        auteur_data.value = "";
        mots_cle_data.value = "";
        ressources_externe_data.value = "";

        let div_auteurs = document.getElementById("liste_auteurs");
        let div_mots_cle = document.getElementById("liste_mots_cle");
        let div_categorie = document.getElementById("liste_categorie");
        let div_external_resources = document.getElementById("external_ressource_list");

        let nom_auteur = document.getElementById("nom");
        let prenom_auteur = document.getElementById("prenom");
        auteur_data.value = `${nom_auteur.value}, ${prenom_auteur.value};`;
        let mot_cle = document.getElementById("input_mot_cle");
        mots_cle_data.value = `${mot_cle.value};`;

        setData(auteur_data, div_auteurs);
        setData(mots_cle_data, div_mots_cle);
        setData(ressources_externe_data, div_external_resources);
    });

    addAuteurBtn.addEventListener('click', function (e){
        stoperPropagation(e);
        let nom_auteur = document.getElementById("nom");
        let prenom_auteur = document.getElementById("prenom");
        let valeur = `${nom_auteur.value}, ${prenom_auteur.value}`;
        ajouterElement("liste_auteurs", valeur);
        nom_auteur.value = "";
        prenom_auteur.value = "";
    });

    addkeyWord.addEventListener('click', function (e){
        stoperPropagation(e);
        let mot_cle = document.getElementById("input_mot_cle");
        let valeur = `${mot_cle.value}`;
        ajouterElement("liste_mots_cle", valeur);
        mot_cle.value = "";
    });


    addRessource.addEventListener('click', function (e){
        stoperPropagation(e);
        let external_ressource = document.getElementById("input_external_ressource");
        let valeur = external_ressource.value;
        ajouterElement("external_ressource_list", valeur);
        external_ressource.value = "";
    });

    function ajouterElement(id_div_liste_elt, valeur_insert){
        const div_liste_elt = document.getElementById(id_div_liste_elt);
        const id = div_liste_elt.children.length+1
        div_liste_elt.innerHTML = div_liste_elt.innerHTML + element(id, valeur_insert, id_div_liste_elt);

    }

    function element(id, text, content_id){
        return `<div class="flex m-3" id="${content_id}-${id}">
                    <input type="text" id="" value="${text}" class="input_elt" disabled/>
                    <button type="button" onclick="removeElt('${content_id}-${id}')" class="button button_delete">supprimer</button>
                </div>`;
    }

    function removeElt(id){
        const tag = document.getElementById(id);
        //console.log(tag);
        tag.remove();
    }

    function stoperPropagation(e) {
        e.preventDefault();
        e.stopPropagation();
    }
</script>
