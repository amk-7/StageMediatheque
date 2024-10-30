@extends('layouts.app', ['page' => 'welcome'])
@section('content')
   <div class="flex flex-col items-center space-y-8">
        <h1 class="label_title text-blue-600">Erreur 500 - Une erreur interne est survenue</h1>
        <p>{{ $exception->getMessage() }}</p>
        <p>Nous rencontrons un problème avec votre demande. Veuillez réessayer plus tard.</p>
   </div>
@stop
