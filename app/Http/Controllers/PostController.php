<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    //

    public function index() {
        return view('post.index');
    }
    
    public function store(Request $request) {
        $this->validate($request, [
            'body' => ['required']
        ]);

        $body = $request->body;
        auth()->user()->posts()->create([
            'body' => $body
        ]);
        // Post::create([
        //     'user_id' => auth()->id(), 
        //     'body' => $body
        // ]);
        return back();
    }
}
