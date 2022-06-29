@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit post</h2>
    <form action="{{route('admin.posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Post title" aria-describedby="titleHelp" value="{{old('title', $post->title)}}">
            <small id="titleHelp" class="text-muted">Type the title here</small>
        </div>
        <div class="mb-3">
            <label for="cover_img" class="form-label">Cover Image</label>
            <img src="{{asset('storage/' . $post->cover_img)}}" width="150" height="100" alt="">
            <input type="file" name="cover_img" id="cover_img" class="form-control" placeholder="https://picsum.com/... " aria-describedby="coverHelp" value="{{old('cover_img', $post->cover_img)}}">
            <small id="coverHelp" class="text-muted">Copy in here the link for your image</small>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <input type="text" name="content" id="content" class="form-control" placeholder="lorem ipsum" aria-describedby="contentHelp"
            value="{{old('content', $post->content)}}">
            <small id="contentHelp" class="text-muted">Write some text in here</small>
        </div>
        <div class="form-group">
            <label for="category_id">Categories</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}" {{$category->id == old('category', $post->category_id) ? 'selected' : ''}}>{{$category->name}}</option>
                @endforeach

            </select>
          </div>
          <div class="form-group">
            <label for="tags">Tags</label>
            <select multiple class="form-control" name="tags[]" id="tags">
                @if($tags)
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}" {{$post->tags->contains($tag) ? 'selected' : ''}}>{{$tag->name}}</option>
                    @endforeach
                @endif
            </select>
            </div>
            @error('tags')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        <button type="submit"> Edit Post</button>
    </form>

</div>
@endsection
