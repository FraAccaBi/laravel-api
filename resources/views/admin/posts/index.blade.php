@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Post list') }}</div>
                @foreach ($posts as $post)
                <div class="card-body d-flex align-items-center justify-content-around row">
                    <h4 class="col-2">{{$post->title}}</h4>
                    <img class="col-2" height="60px" src="{{asset('storage/' . $post->cover_img)}}" alt="">
                    <p class="col-6">{{$post->content}}</p>




                    <div class="col-2 flex-column">
                        <a href="{{route('admin.posts.show', $post->id)}}">View</a>
                        <a href="{{route('admin.posts.edit', $post->id)}}">Edit</a>

                        <button type="button" class="btn btn-danger btn-sm" onclick="$('#delete-post-{{$post->id}}').modal('toggle')">Delete
                        </button>
                    </div>
                    <div class="col-12">
                        <em>Category: {{ $post->category ? $post->category->name : 'Uncategorized'}}</em>
                        <div class="tags">
                            tags:
                            @if(count($post->tags) > 0)
                                @foreach($post->tags as $tag)
                                    {{$tag->name}}
                                @endforeach
                            @else
                                <span>No tags</span>

                            @endif

                        </div>
                    </div>
                 </div>

                <!-- Modal -->
                <div class="modal fade" id="delete-post-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{$post->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete current</h5>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this post?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" onclick="$('#delete-post-{{$post->id}}').modal('toggle')">Close</button>


                                <form action="{{route('admin.posts.destroy', $post->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>


                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
