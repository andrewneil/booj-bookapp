@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="panel-heading"><h3>Your Reading List <a href="/posts/create" class="btn btn-success pull-right">Add Book <span class="glyphicon glyphicon-plus"></span></a></h3></div>
                <div class="panel-body">
                    <br>
                    <h4>Your Books: </h4>
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>@sortablelink('id')</th>
                                <th>Image</th>
                                <th>@sortablelink('title')</th>
                                <th>@sortablelink('author')</th>
                                <th>@sortablelink('Publication Date')</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td><img style="width:100%; max-height:150px; max-width:100px;" src="/storage/cover_images/{{$post->cover_image}}"></td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->author}}</td>
                                    <td>{{$post->publication_date}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                                    <td>
                                        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!} <!-- THIS IS ALL STORED IN AN ARRAY-->
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Remove', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach

                            {{-- {{$posts-links()}} --}}
                        </table>
                        {{-- {!! $posts->appends(Input::except('page'))->links() !!} --}}
                        @else
                        <p>There are no books in your reading list yet.</p> 
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
