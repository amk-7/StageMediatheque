console.log("Ok");

let id_oject = 0;

//============== Initialisation des composant ====================
const addCategorieSelect = document.getElementById("ajouterCategorie");
const addAuteurBtn = document.getElementById("ajouterAuteur");
const addkeyWord = document.getElementById("ajouterMotCle");
const inputSave = document.getElementById("enregistrer");

//console.log(addCategorieSelect);

//============== Ajout des event listener ========================

addkeyWord.addEventListener('click', function addKeyWord(e){
    e.preventDefault();

    let input_mot_cle = document.getElementById("inputMotCle");

    let table_mot_cle = document.getElementById("tableMotCle");
    console.log(table_mot_cle.children[0].children[1].children[0].children[0]);
    let div_ligne_mot_cle = table_mot_cle.children[0].children[1].children[0].children[0];

    let mot_cle_canvas = document.createElement("input");
    mot_cle_canvas.value = `${input_mot_cle.value}`;
    mot_cle_canvas.className = "object_information";

    let remove_mot_cle_btn = document.createElement("button");
    remove_mot_cle_btn.innerText = 'x';

    remove_mot_cle_btn.addEventListener('click', function removeKeyWord(e){
        e.preventDefault();
        e.stopPropagation();
        let table_mot_cle = document.getElementById("tableMotCle");
        let div_ligne_mot_cle = table_mot_cle.children[0].children[1].children[0].children[0];

        let btn = e.explicitOriginalTarget;

        let removeBtn = btn.previousSibling;

        div_ligne_mot_cle.removeChild(removeBtn);
        div_ligne_mot_cle.removeChild(btn);
    });

    input_mot_cle.value = "";
    div_ligne_mot_cle.appendChild(mot_cle_canvas);
    div_ligne_mot_cle.appendChild(remove_mot_cle_btn);
});


inputSave.addEventListener('click', function addDataBeforeSend(e){
    /*e.preventDefault();
    e.stopPropagation();*/


    let table_mot_cle = document.getElementById("tableMotCle");
    let div_ligne_mot_cle = table_mot_cle.children[0].children[1].children[0].children[0];
    let div_auteurs = document.getElementById("listeAuteurs");
    let div_categorie = document.getElementById("listeCategorie");

    let div_ligne_mot_cle_children = div_ligne_mot_cle.children;
    let div_auteurs_chilidren = div_auteurs.children;
    let div_categories_chilidren = div_categorie.children;
    //console.log(div_auteurs_chilidren);
    for(let i=0; i<div_auteurs_chilidren.length; i++){
        if (div_auteurs_chilidren[i].type=="text"){
            console.log(div_auteurs_chilidren[i].value);
            div_auteurs_chilidren[i].setAttribute('name', `auteur${id_oject}`)
            id_oject++;
        }
    }
    id_oject = 0;
    for(let i=0; i<div_categories_chilidren.length; i++){
        if (div_categories_chilidren[i].type=="text"){
            console.log(div_categories_chilidren[i].value);
            div_categories_chilidren[i].setAttribute('name', `categorie${id_oject}`);
            id_oject++;
        }
    }

    id_oject = 0;
    for(let i=0; i<div_ligne_mot_cle_children.length; i++){
        if (div_ligne_mot_cle_children[i].type=="text"){
            console.log(div_ligne_mot_cle_children[i].value);
            div_ligne_mot_cle_children[i].setAttribute('name', `motCle${id_oject}`);
            id_oject++;
        }
    }

    verifieIfAuteurFiledIsNotEmpty();
    verifieIfMotCleFieldIsNotEmpty();
    //console.log(div_auteurs.children);
});

addCategorieSelect.addEventListener('change', function addCategorie(e){
    e.preventDefault();
    e.stopPropagation();
    //console.log(addCategorieSelect.value);
    let div_categorie = document.getElementById("listeCategorie");
    let categorie_canvas = document.createElement("input");
    categorie_canvas.value = `${addCategorieSelect.value}`;
    categorie_canvas.className = "categorie_information";
    let remove_categorie_btn = document.createElement("button");
    remove_categorie_btn.innerText = 'x'
    remove_categorie_btn.id = `${addCategorieSelect.value}`;

    remove_categorie_btn.addEventListener('click', function removeCategorie(e){

        let div_categorie = document.getElementById("listeCategorie");
        let btn = e.explicitOriginalTarget;
        let removeBtn = btn.previousSibling;
        div_categorie.removeChild(removeBtn);
        div_categorie.removeChild(btn);
        //console.log(removeBtn);

        e.preventDefault();
        e.stopPropagation();
    });

    div_categorie.appendChild(categorie_canvas);
    div_categorie.appendChild(remove_categorie_btn);

    addCategorieSelect.value = addCategorieSelect.options[0].innerText

    e.preventDefault();
    e.stopPropagation();
});


addAuteurBtn.addEventListener('click', function addAuteur(e){
    e.preventDefault();
    e.stopPropagation();
    console.log("event");

    const nom_auteur = document.getElementById("nom");
    const prenom_auteur = document.getElementById("prenom");

    let div_auteurs = document.getElementById("listeAuteurs");
    //console.log(nom_auteur.value);
    let auteur_canvas = document.createElement("input");
    auteur_canvas.value = `${nom_auteur.value}, ${prenom_auteur.value}`;
    auteur_canvas.className = "auteur_information";
    let remove_auteur_btn = document.createElement("button");
    remove_auteur_btn.innerText = 'x'
    remove_auteur_btn.id = `${nom_auteur.value}${prenom_auteur.value}`;

    remove_auteur_btn.addEventListener('click', function removeAuteur(e){
        console.log(e);
        let div_auteurs = document.getElementById("listeAuteurs");
        let btn = e.explicitOriginalTarget;
        let removeBtn = btn.previousSibling;
        div_auteurs.removeChild(removeBtn);
        div_auteurs.removeChild(btn);

        e.preventDefault();
        e.stopPropagation();
    });

    div_auteurs.appendChild(auteur_canvas);
    div_auteurs.appendChild(remove_auteur_btn);

    nom_auteur.value = "";
    prenom_auteur.value = "";
    date_naiss.value = "";
    date_decces.value = "";

});

function verifieIfAuteurFiledIsNotEmpty(){
    const nom_auteur = document.getElementById("nom");
    const prenom_auteur = document.getElementById("prenom");

    if (nom_auteur != "" && prenom_auteur != ""){
       nom_auteur.setAttribute("name", "auteur0")
    }
}

function verifieIfMotCleFieldIsNotEmpty(){
    let input_mot_cle = document.getElementById("inputMotCle");

    if (input_mot_cle.value != ""){
        input_mot_cle.setAttribute("name", "mot_cle_0");
    }
}
