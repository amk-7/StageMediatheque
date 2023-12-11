@extends('layouts.app')
@section('content')
    <div>
        <embed src="/storage/books/pdf/{{ $ouvrage->documents }}" width="" height="" type="application/pdf"
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
