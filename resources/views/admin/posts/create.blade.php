@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit post</h2>
    <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Post title" aria-describedby="titleHelp" value="{{old('title')}}">
            <small id="titleHelp" class="text-muted">Type the title here</small>
        </div>
        <div class="mb-3">
            <label for="cover_img" class="form-label">Cover Image</label>
            <input type="file" name="cover_img" id="cover_img" class="form-control" placeholder="https://picsum.com/... " aria-describedby="coverHelp" value="{{old('cover_img')}}">
            <small id="coverHelp" class="text-muted">Copy in here the link for your image</small>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <input type="text" name="content" id="content" class="form-control" placeholder="lorem ipsum" aria-describedby="contentHelp"
            value="{{old('content')}}">
            <small id="contentHelp" class="text-muted">Write some text in here</small>
        </div>
        <div class="form-group">
            <label for="category_id">Categories</label>
            <select class="form-control" name="category_id" id="category_id">
                <option selected disabled>Select a category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach

            </select>
          </div>
          <div class="form-group">
            <label for="tags">Tags</label>
            <select multiple class="form-control" name="tags[]" id="tags">
                @if($tags)
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                @endif
            </select>
            </div>
            @error('tags')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        <button type="submit"> Create Post</button>
    </form>

</div>
@endsection
