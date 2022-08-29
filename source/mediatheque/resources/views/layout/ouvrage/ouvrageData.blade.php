@section("load_json_data")
<script type="text/javascript" async>
    //const liste_auteurs =  {--!! $auteurs !!--};
    const liste_etagers = {!! $classification_dewey_dizaines  !!};

    //sessionStorage.setItem("liste_auteurs", JSON.stringify(liste_auteurs));
    sessionStorage.setItem("liste_etagers", JSON.stringify(liste_etagers))

    //console.log(JSON.parse(sessionStorage.getItem("liste_etagers")));

    const selectRayons = document.getElementById("id_classification_dewey_centaine");
    const selectEtageres = document.getElementById("id_classification_dewey_dizaine");

    //console.log(selectRayons);

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
