<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', ['comments' => $comments]);
    }

    public function apiCommentIndex()
    {
        $comments = Comment::all();
        return $comments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $users = auth()->user();
        $posts = Post::findOrFail($id);
        return view('comments.create', ['user' => $users], ['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'users_id' => 'required|Integer',
            'posts_id'=> 'required|Integer',
            'commentContent' => 'required|max:255',
            ]);

            $c = new Comment;
            $c -> user_id = $validateData['users_id'];
            $c -> post_id = $validateData['posts_id'];
            $c -> commentContent = $validateData['commentContent'];
            $c -> save();

            session() -> flash('message', 'Comment was Created.');
            return redirect()->route('posts.show', ['id' => $c-> post_id]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = auth()->user();
        $comments = Comment::findOrFail($id);
        return view('comments.edit', ['user' => $users], ['comment' => $comments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'users_id' => 'required|Integer',
            'posts_id'=> 'required|Integer',
            'commentContent' => 'required|max:255',
        ]);
            
        $comment = Comment::findOrFail($id);
        $comment -> commentContent = $validateData['commentContent'];
        $comment -> user_id = $validateData['users_id'];
        $comment -> post_id = $validateData['posts_id'];
        $comment -> save();
        session() -> flash('message', 'User Comment was Updated.');
        return redirect()->route('posts.show', ['id' => $comment -> post_id]);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::all();
        $comment = Comment::findOrFail($id);
        foreach($post as $posts){
            if ($posts->id == $comment->post_id){
                $post_id = $comment->post_id;
            }
        }
        $comment -> delete();

        return redirect()->route('posts.show', ['id' => $post_id]);
    }
}