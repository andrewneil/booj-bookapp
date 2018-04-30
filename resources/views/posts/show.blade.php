@extends('layouts.app')

@section('content')
    <h1>Title:  {{$post->title}}</h1>
    <img style="width:100%; max-height:150px; max-width:100px;" src="/storage/cover_images/{{$post->cover_image}}">
    <br><br>
    <div>
        <p>Written by: {{$post->author}}</p>
        <p>Published: {{$post->publication_date}}</p>
    </div>
    <hr>
    <a href="/posts" class="btn btn-default">Go Back</a>
    
    {{-- IF AN USER IS NOT A GUEST, THEN DISPLAY THE EDIT AND DELETE BUTTONS --}}
    {{-- GUEST DO NOT HAVE ACCESS TO EDIT AND DELETE --}}
    {{-- ALSO REGISTERED USERS CAN ALSO SEE EDIT AND DELETE POSTS THEY MADE
        THEMSELVES, AND ONLY CAN VIEW OTHER USER'S POSTS --}}
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!} <!-- THIS IS ALL STORED IN AN ARRAY-->
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
    <hr>
@endsection