<?php

namespace App\Http\Controllers\Backend;

use App\Post;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
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
        $posts = Post::orderBy('id', 'DESC')->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // save
        $post = Post::create([
            'user_id' => auth()->user()->id
        ] + $request->all());
        
        // image
        if ($request->file('file')) {
            $post->image = $request->file('file')->store('posts', 'public');
            
            $post->save();
        }
        
        // return
        return back()->with('status', 'Created succesfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
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
        $post->update($request->all());
        
        //Delete image
        if ($request->file('file')) {
            Storage::disk('public')->delete($post->image);

            $post->image = $request->file('file')->store('posts', 'public');
            
            $post->save();
        }

        return redirect()->route('posts.edit', compact('post'))->with('status', 'Article updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // delete image
        Storage::disk('public')->delete($post->image);

        $post->delete();

        return back()->with('status', 'Article deleted succesfully');
    }
}
