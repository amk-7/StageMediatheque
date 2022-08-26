@extends('layout.ouvrage.ouvrageCreate')
@section('stock')
    <fieldset>
        <legend>Stock</legend>
        <div>
            <label>Nombre d'exemplaire</label>
            <input name="nombre_exemplaire" type="number" value="13" class="@error('nombre_exemplaire') is-invalid @enderror">
            @error('nombre_exemplaire')
                <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>Etat</label>
            <input name="etat" type="text" value="5" class="@error('etat') is-invalid @enderror">
            @error('etat')
            <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>Emplacement</label>
            <div>
                <label>Rayons</label>
                <select id="id_classification_dewey_centaine" name="id_classification_dewey_centaine" class="@error('id_classification_dewey_centaine') is-invalid @enderror">
                    <option>--Selectionner--</option>
                    @foreach($classification_dewey_centaines as $classification_dewey_centaine)
                        <option value="{{$classification_dewey_centaine->id_classification_dewey_centaine}}">{{$classification_dewey_centaine->theme}}</option>
                    @endforeach
                </select>
                @error('id_classification_dewey_centaine')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label>Etagère</label>
                <select id="id_classification_dewey_dizaine" name="id_classification_dewey_dizaine" class="@error('id_classification_dewey_dizaine') is-invalid @enderror">
                    <option>--Selectionner--</option>
                </select>
                @error('id_classification_dewey_dizaine')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </fieldset>
    <script type="text/javascript" async>
        const selectRayons = document.getElementById("id_classification_dewey_centaine");
        const selectEtagere = document.getElementById("id_classification_dewey_dizaine");

        const liste_etager = {!! $classification_dewey_dizaines  !!};

        selectRayons.addEventListener("change", function updateListEtager(e){
            e.stopPropagation();
            console.log(liste_etager);
            console.log(selectRayons.options[selectRayons.selectedIndex].id)
            let i, size = selectEtagere.options.length - 1;
            for (let i = size ; i >= 0 ; i--) {
                selectEtagere.remove(i);
                console.log(i);
            }
            console.log(selectRayons.children);
            let option = document.createElement("option");
            option.innerText = "--Selectionner--";
            selectEtagere.appendChild(option);

            for (let i = 0; i < liste_etager.length ; i++) {
                console.log(liste_etager[i].id_classification_dewey_centaine);
                let idRayon = selectRayons.options[selectRayons.selectedIndex].value;
                let idRayonEtagere = liste_etager[i].id_classification_dewey_centaine;
                if(idRayon == idRayonEtagere){
                    //console.log("Ok");
                    let option = document.createElement("option");
                    option.value = liste_etager[i].id_classification_dewey_dizaine;
                    option.innerText = liste_etager[i].matiere;
                    selectEtagere.appendChild(option);
                }
            }
        });
    </script>

@stop
