@extends('layouts.app')

@section('content')
    <h1>My Books</h1>
    {{-- only view posts the current user has made --}}
    @php
        use App\User;
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
    @endphp

    @if(count($user->posts) > 0) <!-- IF ANY POST EXIST, DISPLAY THEM ALL-->
        @foreach($user->posts as $post)
            <div class="well"> <!-- WELL IS A BOOTSTRAP CLASS -->
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%; max-height:150px; max-width:100px;" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>  <!-- Go to [post] table, display Title row. This will also use the show function, to display contents of the post-->       
                        <p>Author: {{$post->author}}</p>
                        <p>Publication Date: {{$post->publication_date}}</p>
                        {{-- <small>Written on {{$post->created_at}} by {{$post->user->name}}</small> --}}
                    </div>
                </div>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No Posts Found</p> 
    @endif
@endsection