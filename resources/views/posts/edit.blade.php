@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        {{-- TITLE FIELD --}}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>

        {{-- AUTHOR FIELD --}}
        <div class="form-group">
            {{Form::label('author', 'Author')}}
            {{Form::text('author', $post->author, ['class' => 'form-control', 'placeholder' => 'Author'])}}
        </div>

        {{-- PUBLICATION DATE FIELD --}}
        <div class="form-group">
            {{Form::label('publication_date', 'Publication Date')}}
            {{Form::text('publication_date', $post->publication_date, ['id' => 'datepicker','class' => 'form-control', 'placeholder' => 'Publication Date'])}}
        </div>
   
        {{-- COVER IMAGE FIELD --}}
        <div class="form-group">
            {{Form::file('cover_image')}} 
        </div>

        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
