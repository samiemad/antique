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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('users.index', [
			'users' => User::all()
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
			'email' => ['required','email','max:255',Rule::unique('users')],
			'password' => 'required|min:6|max:255|confirmed',
			'username' => ['sometimes', 'max:255', Rule::unique('users','username')],
			'phone' => ['sometimes', 'max:255', Rule::unique('users','phone')],
			'facebook' => ['sometimes', 'max:255', Rule::unique('users','facebook')],
			'google' => ['sometimes', 'max:255', Rule::unique('users','google')],
			'points' => 'required|numeric',
			'credit' => 'required|numeric',
			'gender' => 'required|in:male,female,unspecified',
			'birth' => 'date',
			'location' => 'required|exists:locations,id',
			'referrer' => ['sometimes', Rule::exists('users','id')],
		]);
		$user = new User();

		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = $request->password;
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

		return redirect()->route('users.show',[$user->id]);
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
		$this->validate($request,[
			'name' => 'required|max:255',
			'email' => ['required','email','max:255',Rule::unique('users')->ignore($id)],
			'username' => ['sometimes', 'max:255', Rule::unique('users','username')->ignore($id)],
			'phone' => ['sometimes', 'max:255', Rule::unique('users','phone')->ignore($id)],
			'facebook' => ['sometimes', 'max:255', Rule::unique('users','facebook')->ignore($id)],
			'google' => ['sometimes', 'max:255', Rule::unique('users','google')->ignore($id)],
			'points' => 'required|numeric',
			'credit' => 'required|numeric',
			'gender' => 'required|in:male,female,unspecified',
			'birth' => 'date',
			'location' => 'required|exists:locations,id',
			'referrer' => ['sometimes', Rule::exists('users','id')->whereNot('id', $id)],
		]);
		$user = User::findOrFail($id);

		if( !is_array($request->roles) )
			$request->roles = [];

		if(Auth::user() == $user && !in_array(Role::admin()->id, $request->roles)){
			return redirect()->back()->withErrors(['roles[1]'=> 'You can\'t revoke admin privilage from yourself'])->withInput();
		}

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
		$user = User::findOrFail($id);
		$user->delete();
		return redirect()
				->route('users.index')
				->withMessage('User '.$user->name.' Deleted Successfully');
	}
}
