@extends('layout.template.base', ['page' => 'welcome'])
@section('content')
	
   <!--script type="text/javascript">
       let bg = document.getElementById('bg');
       bg.classList = "w-full h-full";
       let main = document.getElementById('main');
       main.classList = "hiddern";
   </script-->
@stop
@section('slider')
    @include('layout.template.slider')
@stop
@section("footer")
    @include('layout.template.footer')
@stop
