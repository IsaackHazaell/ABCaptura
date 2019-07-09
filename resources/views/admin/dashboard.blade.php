@extends('admin.layout')

@section('content')
  <h1 style="text-align: center;">Bienvenido</h1>
  <br>
  <img src="img/ablogo.jpg" width="25%" height="25%" style="display: block; margin-left: auto; margin-right: auto; ">
@stop

@section('adminlte_js')
    <script>
    //SWETALERT
    @if (Session::has('message'))
            sAlert(
            "{{ Session::get('message.title') }}",
            "{{ Session::get('message.text') }}",
            "{{ Session::get('message.icon') }}"
        );
    @endif

    function sAlert(title, text, icon)
    {
      swal({
        title: title,
        text: text,
        icon: icon,
        button: "Continue",
        timer: 3000
      });
    }
    </script>
@stop
