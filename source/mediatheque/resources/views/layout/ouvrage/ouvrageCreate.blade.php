@extends('layout.base')
@section("livewire_style_content")
    @livewireStyles
@stop

@section("livewire_script_content")
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
@stop

@section('content')
    <h1 class="font-bold">{{$title}}</h1>
    <form action="{{route($action)}}" method="post" enctype="multipart/form-data">
        @csrf
        @livewire('ouvrage-create.create', [
        'niveaus'=>$niveaus,
        'types'=>$types,
        'langues'=>$langues
        ])
        <input type="submit" id="enregistrer" name="enregister" value="Enregister"/>
    </form>
    @include("layout.ouvrage.ouvrageJS.ouvrageLoadFile")
    @include("layout.ouvrage.ouvrageJS.ouvrageSendDataFormat")
    <x-livewire-alert::flash />
    <!--script src="{--{ url('mediatheque_js/ouvrage/_ouvrage.js') }--}" async></script-->

@stop
