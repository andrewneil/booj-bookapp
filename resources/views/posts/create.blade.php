@extends('layouts.app')

@section('content')

    <h1>Create Post</h1>
    <!-- 'enctype' => 'multipart/data'  allows for file uploading -->
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        {{-- TITLE FIELD --}}
        <div class="form-group">
            {{Form::label('title', 'Title:')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>

        {{-- AUTHOR FIELD --}}
        <div class="form-group">
            {{Form::label('author', 'Author:')}}
            {{Form::text('author', '', ['class' => 'form-control', 'placeholder' => 'Author'])}}
        </div>

        {{-- PUBLICATION DATE FIELD --}}
        <div class="form-group">
            {{Form::label('publication_date', 'Publication Date')}}
            {{Form::text('publication_date', $post->publication_date, ['id' => 'datepicker','class' => 'form-control', 'placeholder' => 'Publication Date'])}}
        </div>

        {{-- COVER IMAGE FIELD --}}
        <div class="form-group">
            {{Form::label('cover_image', 'Cover Image:')}}
            <!-- FIELD TO ATTACH FILES AND IMAGES -->
            {{Form::file('cover_image')}}
        </div>
        
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection

