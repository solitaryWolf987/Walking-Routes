<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

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
        $users = User::all();
        //dump($users);
        return view('posts.index', ['posts' => $posts], ['users' => $users]);
    }
    

    public function apiPostIndex($id)
    {
        $posts = Post::findOrFail($id);
        return $posts;
    }

    public function apiUserIndex()
    {
        $users = User::all();
        return $users;
    }

    public function apiCommentIndex()
    {
        $comments = Comment::all();
        return $comments;
    }

        

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = auth()->user();
        return view('posts.create', ['users' => $users]);
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
            'postTitle' => 'required|max:255',
            'postContent' => 'required|max:255',
            'file_path' => 'mimes: doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
            'users_id' => 'required|Integer',
            'coordinates' => 'required|json',
        ]);

        
        dump($validateData['coordinates']);
            

            if ($request->hasFile('file_path')){
                $file = $request->file('file_path');
                $filename = $file->getClientOriginalName();
                $file->storeAs('public/images', $filename);
            }
            else {
                $filename = null;
            }
            $p = new Post;
            $p -> postTitle = $validateData['postTitle'];
            $p -> postContent = $validateData['postContent'];
            $p -> file_path = $filename;
            $p -> user_id = $validateData['users_id'];
            $p -> coordinates = $validateData['coordinates'];
            $p -> save();
            
            
    

            session() -> flash('message', 'User Post was Created.');
            return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $users = User::all();
        return view('posts.show', ['posts' => $post], ['users' => $users]);
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
        $posts = Post::findOrFail($id);
        return view('posts.edit', ['user' => $users], ['post' => $posts]);
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
            'postTitle' => 'required|max:255',
            'postContent' => 'required|max:255',
            'file_path' => 'mimes: doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
            'users_id' => 'required|Integer',
        ]);
            if ($request->hasFile('file_path')){
                $file = $request->file('file_path');
                $filename = $file->getClientOriginalName();
                $file->storeAs('public/images', $filename);
            }
        $post = Post::findOrFail($id);
        $post -> postTitle = $validateData['postTitle'];
        $post -> postContent = $validateData['postContent'];
        $post -> file_path = $filename;
        $post -> user_id = $validateData['users_id'];
        $post -> save();
        session() -> flash('message', 'User Post was Updated.');
        return redirect()->route('posts.show', ['id' => $post -> id]);       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $comment = Comment::all();
        foreach($comment as $comments){
            if ($comments->posts_id == $post->id){
                $comments->delete();        
            }
        }
        $post -> delete();

        return redirect()->route('dashboard'); 
    }

    
}