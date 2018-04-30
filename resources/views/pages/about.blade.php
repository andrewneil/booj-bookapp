{{-- <!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name', 'BookApp')}}</title>
    </head>
    <body>
        <h1>About</h1>
        <p>This is where you can learn all about BookApp.</p>
    </body>
</html> --}}


@extends('layouts.app')

@section('content')
    <h1><?php echo $title; ?></h1>
    <p>This is where you can learn all about BookApp.</p>
 @endsection