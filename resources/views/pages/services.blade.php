{{-- ^^^^^^ ORIGINAL ^^^^^^ --}}
{{-- <!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name', 'BookApp')}}</title>  <!-- The app name is hard coded in the .env file. -->
    </head>
    <body>
        <h1>Services</h1>
        <p>This is the Services that BookApp provides.</p>
    </body>
</html> --}}
{{-- ^^^^^^ ORIGINAL ^^^^^^ --}}



{{-- ///////////////////////////////////////// --}}
{{-- THIS IS A VIEW FILE FOR THE SERVICES PAGE --}}
{{-- ///////////////////////////////////////// --}}

{{-- BELOW IS THE @YIELD WAY OF MAKING CLEANER AND REUSABLE CODE --}}
@extends('layouts.app') <!-- THIS IS THE FOLDER/FILE LOCATION OF THE LAYOUT -->

@section('content')
    <h1>{{$title}}</h1>
    {{-- <p>This is the Services that BookApp provides.</p> --}}
    {{-- IF STATEMENT, WITH A FOREACH LOOP INSIDE --}}
    @if(count($services) > 0)  <!-- Checks to see if there is at least 1 'service' in the 'services' array (array in PagesController) -->
        <ul class="list-group">
            @foreach($services as $service)
                <li class="list-group-item">{{$service}}</li>
            @endforeach 
        </ul>
    @endif
@endsection