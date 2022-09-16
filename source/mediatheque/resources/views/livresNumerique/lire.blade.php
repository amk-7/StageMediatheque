@extends('layout.template.base')
@section('content')
    <div>
        <!-- strtolower(str_replace(' ', '_', $ouvragesElectronique->ouvrage->titre).'.pdf#toolbar=0')) >
        <iframe src=""  width="100%" height="500px"></iframe-->
        <embed src="{{ asset('storage/ouvrage_electonique/'.strtolower(str_replace(' ', '_', $ouvrage->titre).'.pdf')) }}" width="" height="" type="application/pdf"
                id="read_canvas"
        />
    </div>
@stop
@section('js')
    <script type="text/javascript" async>
        read_canvas = document.getElementById('read_canvas');
        read_canvas.width = innerWidth-100;
        read_canvas.height = innerHeight-100;
        console.log(read_canvas);
    </script>
@stop
