<script type="text/javascript" async>
    console.log("Cool");
    let id_search_bar = "ouvrage_code_id";
    let options_class_name = "ouvrages_titre";
    let id_select_attribute = "titre_ouvrage";
    let input_searche_bar = document.getElementById(id_search_bar);
    let select_attribute = document.getElementById(id_select_attribute);

    input_searche_bar.addEventListener("keyup", function () {
        search_object(id_search_bar, options_class_name);
    }, false);

    let search_options = document.getElementById("searche_options").children;
    console.log(search_options)
    for (let i = 0; i < search_options.length; i++) {
        search_options[i].addEventListener("click", function () {
            applySelected(search_options[i].id, select_attribute);
        }, false);
        console.log(search_options[i]);
    }


    function applySelected(id_elt, select_attribute) {
        let li = document.getElementById(id_elt);
        console.log(id_elt);
        select_attribute.value=li.innerText;
    }
</script>
