<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        $data = [
            'users' => $users,
        ];
        return view('sections.users.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'user' => $user,
        ];
        return view('sections.users.edit')->with('data', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191|alpha_dash',
            'email' => 'required|string|email|max:191|unique:users,email,' . $id,
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048',
            'password' => 'nullable|min:8'
        ]);
        $user = User::findOrFail($id);
        $currentAvatar = $user->avatar;

        empty($request['password']) ? $request->merge(['password' => $user->password])
            :
            $request->merge(['password' => Hash::make($request['password'])]);
        $user->update($request->except('avatar'));
        if($request->file('avatar')!= $currentAvatar && $request->hasFile('avatar')) {
            $destinationPath = 'img/avatar/';
            $name = Str::of($user->name)->lower()->slug() . '-'. $user->id . '.'.request()->avatar->getClientOriginalExtension();
            $request->file('avatar')->move($destinationPath, $name);
            $user->avatar = $destinationPath.$name;
            $user->update();
        }
        return redirect()->back()->with('status', 'Profilo modificato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
