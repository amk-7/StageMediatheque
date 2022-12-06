@extends('layout.template.base')
@section("livewire_styles_content")
    @livewireStyles
@stop
@section("styles")
    <style type="text/css">

        .card{
            width: 200px;
            height: 350px;
            margin: auto;
        }
        .image {
            width: 198px;
            height: 300px;
        }
        .image img {
            width: 100%;
            height: 100%;
        }
        .label {
            padding: 10px 2%;
            justify-content: center;
            text-align: center;
        }

        .online {
            position: relative;
        }
        .online::after {
            position: absolute;
            content: "3";
            background: red;
            width: 30px;
            height: 20px;
            border-radius: 4px ;
            color: white;
            right: 0px;
            text-align: center;
        }
    </style>
@endsection
@section("content")
    @livewire('ouvrage.index-livre-numerique-livewire', [
    'annees'=>$annees,
    'niveaus'=> $niveaus,
    'types'=>$types,
    'langues'=>$langues,
    'categories'=>$categories,
    'id_livre_numerique'=>$id_livre_numerique
    ])
@stop
@section("livewire_scripts_content")
    @livewireScripts
@stop
@section('js')
    <script type="text/javascript">
        let div_table = document.getElementById('id_table_liste');
        let div_new_table = document.getElementById('id_table_ouvrage');
        let div_table_children = div_table.children;
        let size_square = 4;
        let screan_width = innerWidth;
        let screan_height = innerHeight;
        if (screan_width >= 960){
            let size_square = 4;
        }
        let nb_div_square = parseInt(div_table_children.length/size_square);
        let nb_div_note_square = div_table_children.length-nb_div_square*size_square;
        console.log(nb_div_square);
        console.log(nb_div_note_square);
        for (let i = 0; i < nb_div_square; i++) {
            let div = document.createElement('div');
            div.classList = "flex flex-row";
            for (let j = 0; j < nb_div_square; j++) {
                div.append(div_table[i+j]);
            }
            div_new_table.append(div);
        }
    </script>
@stop
