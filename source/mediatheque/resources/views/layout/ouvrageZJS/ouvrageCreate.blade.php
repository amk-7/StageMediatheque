
@section('ouvrage_content_js')
    <script type="text/javascript" async>
        console.log("Cool");
        let id_search_bar = "nom";
        let options_class_name = "auteurs";
        let id_select_prenom = "prenom";
        let input_searche_bar = document.getElementById(id_search_bar);
        let select_prenom = document.getElementById(id_select_prenom);

        input_searche_bar.addEventListener("keyup", function () {
            search_object(id_search_bar, options_class_name);
        }, false);

        let search_options = document.getElementById("searche_options").children;

        for (let i = 0; i < search_options.length; i++) {
            search_options[i].addEventListener("click", function () {
                applySelected(input_searche_bar, search_options[i].id, select_prenom);
            }, false);
            console.log(search_options[i]);
        }

        function search_object(id_searchbar, class_elts) {
            let input = document.getElementById(id_searchbar).value
            input = input.toLowerCase();
            let x = document.getElementsByClassName(class_elts);

            for (i = 0; i < x.length; i++) {
                if (!x[i].innerHTML.toLowerCase().includes(input)) {
                    x[i].style.display = "none";
                } else {
                    x[i].style.display = "list-item";
                }
            }
        }

        function applySelected(input, id_elt, select_prenom) {
            let li = document.getElementById(id_elt);
            let nom_prenom = li.innerText.split("-");
            console.log(select_prenom);
            input.value = nom_prenom[0];
            select_prenom.value=nom_prenom[1];
        }
    </script>
@stop
@section('ouvrage_physique_content_js')
    <script type="text/javascript" async>
        const liste_etagers = {!! $classification_dewey_dizaines  !!};

        //sessionStorage.setItem("liste_auteurs", JSON.stringify(liste_auteurs));
        sessionStorage.setItem("liste_etagers", JSON.stringify(liste_etagers))

        //console.log(JSON.parse(sessionStorage.getItem("liste_etagers")));

        const selectRayons = document.getElementById("id_classification_dewey_centaine");
        const selectEtageres = document.getElementById("id_classification_dewey_dizaine");

        console.log(selectRayons);

        selectRayons.addEventListener("change", function updateListEtager(e) {
            e.stopPropagation();
            let size = selectEtageres.options.length - 1;
            for (let i = size; i >= 0; i--) {
                selectEtageres.remove(i);
            }
            let option = document.createElement("option");
            option.innerText = "--Selectionner etagère--";
            selectEtageres.appendChild(option);

            for (let i = 0; i < liste_etagers.length; i++) {
                let idRayon = selectRayons.options[selectRayons.selectedIndex].value;
                let idRayonEtagere = liste_etagers[i].id_classification_dewey_centaine;
                if (parseInt(idRayon) === parseInt(idRayonEtagere)) {
                    let option = document.createElement("option");
                    option.value = liste_etagers[i].id_classification_dewey_dizaine;
                    option.innerText = liste_etagers[i].matiere;
                    selectEtageres.appendChild(option);
                }
            }
        });
    </script>
@stop

