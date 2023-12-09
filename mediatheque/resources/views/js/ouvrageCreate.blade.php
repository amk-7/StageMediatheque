<script type="text/javascript" async>

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
        //console.log(search_options[i]);
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
