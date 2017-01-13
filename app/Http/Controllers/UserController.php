<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', [
            'users' => $users
            ]);
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
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.show',[
            'user'=>User::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('users.edit',[
            'user'=>User::findOrFail($id)]);
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
        // dd($request);

        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => ['required','email','max:255',Rule::unique('users')->ignore($id)],
            'username' => ['max:255', Rule::unique('users','username')->ignore($id)],
            'phone' => ['max:255', Rule::unique('users','phone')->ignore($id)],
            'facebook' => ['max:255', Rule::unique('users','facebook')->ignore($id)],
            'google' => ['max:255', Rule::unique('users','google')->ignore($id)],
            'points' => 'required|numeric',
            'credit' => 'required|numeric',
            'gender' => 'required',
            'birth' => 'date',
            'location' => 'required|exists:locations,id',
            'referrer' => ['sometimes', Rule::exists('users','id')->whereNot('id', $id)],
        ]);
        $user = User::findOrFail($id);

        if(Auth::user() == $user && !in_array(Role::admin()->id, $request->roles)){
            return redirect()->back()->withErrors(['roles[1]'=> 'You can\'t revoke admin privilage from yourself'])->withInput();
        }

        // dd($user);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->facebook = $request->facebook;
        $user->google = $request->google;
        $user->points = $request->points;
        $user->credit = $request->credit;
        $user->gender = $request->gender;
        $user->birth = $request->birth;
        $user->location()->associate($request->location);
        if ($request->referrer) {
            $user->referrer()->associate($request->referrer);
        }else{
            $user->referrer()->dissociate();
        }

        $user->save();

        $user->roles()->sync($request->roles);
        // foreach($request->roles as $r){
            // var_dump($request->roles);
        // }

        return redirect()->route('users.show',[$id]);
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
