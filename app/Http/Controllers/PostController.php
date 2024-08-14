<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controle;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }
    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->with(['user','likes'])->paginate(20);   //returns a laravel collection, only the number of records specified, gets all the posts can use where, find, first, latest, oldest, etc Eager loading??
        return view('posts.index', ['posts' => $posts]);
    }

    public function show(Post $post){
        return view('posts.show',[
            'post' => $post,

        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'body' => 'required',
        ]);
       //
    //    Post::create([
    //     'user_id' => auth()->user()->id(),
    //     'body' => $request->body,
    //    ]);
    $request->user()->posts()->create($request->only('body'));
    return back();
    }

    public function destroy(Post $post){
        // if(!$post->ownedBy(auth()->user())){         // edited out because we added a policy

        // }
        $this->authorize('delete', $post);  // delete is the method in the PostPolicy
        $post->delete();
        return back();
    }
}
