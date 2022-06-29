<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Mail\NewPostCreated;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        /* $data = $request->all();
        dd($data); */
        $val_data = $request->validated();
        //dd($val_data);

        //generate slug
        //$slug = Post::generateSlug($request->title);
        //$val_data['slug']= $slug;
        $val_data['user_id'] =Auth::id();

        $request->validate(
            [
                'cover_img' => 'nullable|image|max:250',
            ]
            );
        $path = Storage::put('post_img', $request->cover_img);
        $val_data['cover_img'] = $path;

        $new_post = Post::create($val_data);
        $new_post->tags()->attach($request->tags);

        //return (new NewPostCreated($new_post))->render();

        Mail::to($request->user())->send(new NewPostCreated($new_post));

        return redirect()->route('admin.posts.index')->with('message', 'Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $val_data = $request->validated();
        //$slug = Post::generateSlug($request->title);
        // old slug version
       /*  $slug = Str::slug($request->title,'-'); */
        //$val_data['slug'] = $slug;


            //validation
            $request->validate([
                'cover_image' => 'nullable|image|max:500'
            ]);
            //save
            Storage::delete($post->cover_img);
            //take path
            $path = Storage::put('post_img', $request->cover_img);


            //pass the path of array
            $val_data['cover_img'] = $path ;




        $post->tags()->sync($request->tags);
        $post->update($val_data);

        //$post->tags()->sync($val_data['tags']);
        return redirect()->route('admin.posts.index')->with('message', "$post->title updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete($post->cover_img);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', "$post->title deleted successfully");
    }
}
