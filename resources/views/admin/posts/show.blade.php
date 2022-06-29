@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <img src="{{$post->cover_img}}" alt="" srcset="">
                <h1>{{$post->title}}</h1>
                <p>{{$post->content}}</p>

            </div>
        </div>
    </div>
</div>
@endsection
