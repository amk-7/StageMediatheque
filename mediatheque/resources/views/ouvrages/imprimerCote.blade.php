@extends('layouts.app')
@section("content")
    <div class="flex flex-col justify-center items-center m-auto my_content">
        <h1 class="text-3xl mb-3">Cotes Ouvrages</h1>
        <button type="button" id="print" class="button button_primary">Imprimer</button>
        @if(!empty($ouvrages ?? "") && $ouvrages->count())
            @if(Auth::user() && Auth::user()->hasRole('bibliothecaire'))
            <div class="grid grid-cols-6 gap-12 mt-6 bg-white p-3">
                @foreach($ouvrages as $ouvrage)
                <div>
                    {{-- <a href="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(200)->generate("ezrzr")) }}"
                        download="{{ 'cote'.str_replace(' ', '_', strtolower($ouvrage->titre)).'qrcode.png' }}">

                    </a> --}}
                    {{ QrCode::generate($ouvrage->cote) }}
                </div>
                @endforeach
            </div>
            @endif
        @else
            <h3>Il n'y a aucune cote d'ouvrage.</h3>
        @endif

    </div>
@stop
@section('js')
<script type="text/javaScript">
    $('#print').on('click', ()=>{
        print();
    });
</script>
@endsection
