@extends('layout.template.base', ['page' => 'welcome'])
@section('content')
   <div class="flex flex-col items-center space-y-8">
       <img style="border-radius: 20px" src="{{ asset('storage/images/logo2.png') }}">
       <h1 class="label_title text-blue-600">Oups ! Page non trouvé.</h1>
   </div>
@stop
