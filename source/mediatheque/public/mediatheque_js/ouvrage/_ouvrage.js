console.log("Ok");
let id_auteur = 0;
let id_categorie = 0;
let id_niveau = 0;

//============== Initialisation des composant ====================
const addCategorieSelect = document.getElementById("ajouterCategorie");
const addAuteurBtn = document.getElementById("ajouterAuteur");
const selectRayons = document.getElementById("id_classification_dewey_centaine");

const inputSave = document.getElementById("enregistrer");

//console.log(addCategorieSelect);

//============== Ajout des event listener ========================

inputSave.addEventListener('click', function addDataBeforeSend(e){
    /*e.preventDefault();
    e.stopPropagation();*/

    const inputAuteurs = document.getElementById("auteurs");
    const inputCategories = document.getElementById("categories");

    let div_auteurs = document.getElementById("listeAuteurs");
    let div_categorie = document.getElementById("listeCategorie");
    let div_auteurs_chilidren = div_auteurs.children;
    let div_categories_chilidren = div_categorie.children;

    for(let i=0; i<div_auteurs_chilidren.length; i++){
        if (div_auteurs_chilidren[i].type=="text"){
            console.log(div_auteurs_chilidren[i].value);
            inputAuteurs.value += div_auteurs_chilidren[i].value+";"
        }
    }

    for(let i=0; i<div_categories_chilidren.length; i++){
        if (div_categories_chilidren[i].type=="text"){
            console.log(div_categories_chilidren[i].value);
            inputCategories.value += div_categories_chilidren[i].value+";"
        }
    }

    //console.log(div_auteurs.children);
})

selectRayons.addEventListener('change', function addEtagerInSelect(e){
    e.preventDefault();
});

addCategorieSelect.addEventListener('change', function addCategorie(e){
    e.preventDefault();
    //console.log(addCategorieSelect.value);
    let div_categorie = document.getElementById("listeCategorie");
    let categorie_canvas = document.createElement("input");
    categorie_canvas.value = `${addCategorieSelect.value}`;
    categorie_canvas.name = "categorie"+id_categorie;
    categorie_canvas.id = id_categorie;
    categorie_canvas.className = "categorie_information";
    id_categorie++;
    let remove_categorie_btn = document.createElement("button");
    remove_categorie_btn.innerText = 'x'
    remove_categorie_btn.id = `${addCategorieSelect.value}`;

    remove_categorie_btn.addEventListener('click', function removeCategorie(e){
        e.preventDefault();
        e.stopPropagation();
        let div_categorie = document.getElementById("listeCategorie");
        let btn = e.explicitOriginalTarget;
        let removeBtn = btn.previousSibling;
        //console.log(id_categorie);
        div_categorie.removeChild(removeBtn);
        div_categorie.removeChild(btn);
        //console.log(removeBtn);
    });

    div_categorie.appendChild(categorie_canvas);
    div_categorie.appendChild(remove_categorie_btn);
});


addAuteurBtn.addEventListener('click', function addAuteur(e){
    e.preventDefault();
    console.log("event");

    const nom_auteur = document.getElementById("nom");
    const prenom_auteur = document.getElementById("prenom");
    const date_naiss = document.getElementById("date_naissance");
    const date_decces = document.getElementById("date_decces");

    let div_auteurs = document.getElementById("listeAuteurs");

    //console.log(nom_auteur.value);

    let auteur_canvas = document.createElement("input");
    auteur_canvas.value = `${nom_auteur.value}, ${prenom_auteur.value}, ${date_naiss.value}, ${date_decces.value}`;
    auteur_canvas.name = "auteur"+id_auteur;
    auteur_canvas.className = "auteur_information";
    id_auteur++;
    let remove_auteur_btn = document.createElement("button");
    remove_auteur_btn.innerText = 'x'
    remove_auteur_btn.id = `${nom_auteur.value}${prenom_auteur.value}`;

    remove_auteur_btn.addEventListener('click', function removeAuteur(e){
        e.preventDefault();
        e.stopPropagation();
        let div_auteurs = document.getElementById("btnAuteurs");
        let btn = e.explicitOriginalTarget;
        //console.log(btn);
        let removeBtn = btn.previousSibling;
        div_auteurs.removeChild(removeBtn);
        div_auteurs.removeChild(btn);
        //console.log(removeBtn);
        e.preventDefault();
    });

    div_auteurs.appendChild(auteur_canvas);
    div_auteurs.appendChild(remove_auteur_btn);

});

/*function addObjectElement(object_name, div_objet, id_div_objet, id_object, object_value){
    console.log(addCategorieSelect.value);
    div_objet = document.getElementById(id_div_objet);
    let objet_canvas = document.createElement("input");
    objet_canvas.value = `${addCategorieSelect.value}`;
    objet_canvas.name = object_name+id_categorie;
    objet_canvas.className = "object_information";
    id_object++;
    let remove_object_btn = document.createElement("button");
    remove_object_btn.innerText = 'x'
    remove_object_btn.id = `${object_value}`;

    remove_object_btn.addEventListener('click', removeCategorie);

    div_objet.appendChild(categorie_canvas);
    div_objet.appendChild(categorie_btn);
}

function removeCategorie(){
    e.preventDefault();
    let div_categorie = document.getElementById("listeCategorie");
    let btn = e.explicitOriginalTarget;
    console.log(btn);
    let removeBtn = btn.previousSibling;
    div_categorie.removeChild(removeBtn);
    div_categorie.removeChild(btn);
    //console.log(removeBtn);
}*/
//formulaire_enregistrement_livre_papier
