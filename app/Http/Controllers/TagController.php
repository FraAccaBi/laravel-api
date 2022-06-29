<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all()); // get the request
        //dd($request->tags); // get all tags

        // validare i dati
        $validatedData = $request->validate([
           'title' => 'required',
           'body' => 'required'
        ]);
       $new_post = Post::create($validatedData);


        // attach all tags to the post
        $new_post->tags()->attach($request->tags);

        return redirect()->route('admin.posts.show', $new_post);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {

        //dd($request->tags); // check the tags first with a dd

        // validare i dati
         $validatedData = $request->validate([
           'title' => 'required',
           'body' => 'required',
           'tags' => 'exists:tags,id' //validate tags
        ]);

        //update post data
        $tag->update($validatedData);

        // Update tags with sync
        return redirect()->back()->with('message', "Tag $request->title updated successfully");




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
