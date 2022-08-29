@extends("layout.base")
@section("livewire_style_content")
    @livewireStyles
@stop

@section("livewire_script_content")
    @livewireScripts
@stop

@section("content")
    <h1>Approvisionnement d'un ouvrage</h1>
    <form action="{{ route('enregistementApprovisionnement') }}" method="post">
        @csrf
        @livewire('approvisionement.create', [
        'ouvragesPhysique' => $ouvragesPhysique,
        'personnels' => $personnels
        ])
        <input type="submit" name="action_approvisionnement" value="Approvisionner">
    </form>
@stop
@section("js")
    <script type="text/javascript">
        let input_searche_bar_ouvrage_physique = document.getElementById("searche_ouvrgae_physique");
        let hidden_input_searche_bar_ouvrage_physique = document.getElementById("searche_ouvrgae_physique_cle");
        let input_annee_apparution = document.getElementById("annee_apparution");


        input_searche_bar_ouvrage_physique.addEventListener("keyup", function (){
            search_object("searche_ouvrgae_physique", "ouvrages_physique");
            if (input_searche_bar_ouvrage_physique.value == ""){
                input_annee_apparution.value = "";
            }
        }, false);

        let search_options = document.getElementById("searche_options").children;

        for (let i = 0; i < search_options.length ; i++) {
            search_options[i].addEventListener("click", function (){
                applySelected(input_searche_bar_ouvrage_physique, search_options[i].id, hidden_input_searche_bar_ouvrage_physique, input_annee_apparution);
            }, false);
            console.log(search_options[i]);
        }

        function search_object(id_searchbar, class_elts) {
            console.log("ok");
            let input = document.getElementById(id_searchbar).value
            input=input.toLowerCase();
            let x = document.getElementsByClassName(class_elts);

            for (i = 0; i < x.length; i++) {
                if (!x[i].innerHTML.toLowerCase().includes(input)) {
                    x[i].style.display="none";
                }
                else {
                    x[i].style.display="list-item";
                }
            }
        }
        function applySelected(input, id_elt, input_hidden, input_annee){
            let li = document.getElementById(id_elt);
            input.value = li.innerText;
            let id_annne_ouvrage = id_elt.split(",");
            let id = id_annne_ouvrage[0];
            let annee = id_annne_ouvrage[1];
            input_hidden.value = id;
            input_annee.value = annee;
        }
    </script>
@stop
