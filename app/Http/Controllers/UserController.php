<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->sortBy('name');
        //dump($users);
        return view('users.index', ['users' => $users]);
    }

    public function apiIndex()
    {
        $users = User::all();
        return $users;
    }

    public function apiStore(Request $request)
    {
        $u = new User();
        $u->name = $request['name'];
        $u->save();
        return $u;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'name' => 'required|max:255',
            'LastName' => 'required|max:255',
            'age' => 'required|integer',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            ]);

        $u = new User;
        $u -> name = $validateData['name'];
        $u -> LastName = $validateData['LastName'];
        $u -> age = $validateData['age'];
        $u -> email = $validateData['email'];
        $u -> password = $validateData['password'];
        $u -> save();

        session() -> flash('message', 'User Profile was Created.');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'LastName' => 'required|max:255',
            'age' => 'required|integer',
            'email' => 'required|max:255',
            ]);
        $user = auth()->user();
        $user -> name = $validateData['name'];
        $user -> LastName = $validateData['LastName'];
        $user -> age = $validateData['age'];
        $user -> email = $validateData['email'];
        $user -> save();
        
        session() -> flash('message', 'User profile was updated.');
        return redirect()->route('users.show', ['id' => $user -> id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
