<script type="text/javascript" async>
    console.log("Ok");

    let id_oject = 0;
    //============== Initialisation des composant ====================
    const addCategorieSelect = document.getElementById("ajouter_categorie");
    const addGenreSelect = document.getElementById("ajouter_genre");
    const addAuteurBtn = document.getElementById("ajouter_auteur");
    const addkeyWord = document.getElementById("ajouter_mot_cle");
    const inputSave = document.getElementById("enregistrer");

    //============== Ajout des event listener ========================

    function setData(input_data, div_liste_data){
        let div_liste_data_chilidren = div_liste_data.children;
        for(let i=0; i<div_liste_data_chilidren.length; i++){
            if (div_liste_data_chilidren[i].type==="text"){
                input_data.value += `${div_liste_data_chilidren[i].value};`;
            }
        }
    }

    inputSave.addEventListener('click', function addDataBeforeSend(e){
        let auteur_data = document.getElementById('data_auteurs');
        let mots_cle_data = document.getElementById('data_mots_cle');
        let categorie_data = document.getElementById('data_categorie');

        auteur_data.value = "";
        mots_cle_data.value = "";
        categorie_data.value = "";

        let div_auteurs = document.getElementById("liste_auteurs");
        let div_mots_cle = document.getElementById("liste_mots_cle");
        let div_categorie = document.getElementById("liste_categorie");
        let div_genre = document.getElementById("listeGenre");
        console.log(div_mots_cle);

        let nom_auteur = document.getElementById("nom");
        let prenom_auteur = document.getElementById("prenom");
        auteur_data.value = `${nom_auteur.value}, ${prenom_auteur.value};`;
        let mot_cle = document.getElementById("input_mot_cle");
        mots_cle_data.value = `${mot_cle.value};`;

        setData(auteur_data, div_auteurs);
        setData(mots_cle_data, div_mots_cle);
        setData(categorie_data, div_categorie);
    });

    if (addCategorieSelect != null){
        addCategorieSelect.addEventListener('change', function (e){
            stoperPropagation(e);
            let valeur = `${addCategorieSelect.value}`;
            ajouterElement('liste_categorie', valeur);
            addCategorieSelect.value = addCategorieSelect.options[0].innerText
        });
    }

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

    if (addGenreSelect != null){
        addGenreSelect.addEventListener('change', function addCategorie(e){
            stoperPropagation(e);
            let valeur = `${addGenreSelect.value}`;
            ajouterElement('liste_categorie', valeur);
            addGenreSelect.value = addGenreSelect.options[0].innerText
        });
    }

    function ajouterElement(id_div_liste_elt, valeur_insert){

        let div_liste_elt = document.getElementById(id_div_liste_elt);
        let elt_canvas = document.createElement("input");
        elt_canvas.value = valeur_insert ;
        elt_canvas.className = "input_elt";
        elt_canvas.disabled = true;
        elt_canvas.id = valeur_insert;
        let remove_elt_btn = document.createElement("button");
        remove_elt_btn.innerText = "x"
        remove_elt_btn.className = "button_remove_elt button_delete"
        remove_elt_btn.name=valeur_insert;

        remove_elt_btn.addEventListener('click', function removeAuteur(e){
            let div_auteurs = document.getElementById(id_div_liste_elt);
            let btn = e.srcElement;
            stoperPropagation(e);
            //let removeBtn = btn.previousSibling; //voici le souci sur chrome
            let removeBtn = document.getElementById(btn.name); //voici le souci sur chrome
            console.log(btn);
            div_auteurs.removeChild(removeBtn);
            div_auteurs.removeChild(btn);
        } , {capture: true});

        div_liste_elt.appendChild(elt_canvas);
        div_liste_elt.appendChild(remove_elt_btn);
    }

    function  stoperPropagation(e){
        e.preventDefault();
        e.stopPropagation();
    }
</script>
