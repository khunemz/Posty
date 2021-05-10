<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    //

    public function index() {
        $posts = Post::orderBy('created_at','desc')->with('user','likes')->paginate(10);
        return view('post.index',[
            'posts' => $posts
        ]);
    }
    
    public function store(Request $request) {
        $this->validate($request, [
            'body' => ['required']
        ]);

        $body = $request->body;
        auth()->user()->posts()->create($request->only('body'));
        // Post::create([
        //     'user_id' => auth()->id(), 
        //     'body' => $body
        // ]);
        return back();
    }

    public function destroy(Post $post) {

        // if($post->ownedBy(auth()->user())){
        //     return  response(null, 403);
        // }
        $this->authorize('delete', $post);
        $post->delete();
        return back();
    }
}
