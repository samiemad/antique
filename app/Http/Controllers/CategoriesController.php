<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','role:moderator']);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('categories.index');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function browse($id = 1)
	{
		return view('categories.browse', ['category'=>Category::findOrFail($id)]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create($id = 1)
	{
		return view('categories.create',['id'=>$id]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:255',
			'description' => 'required|max:1000',
			'advice' => 'required|max:1000',
			'parent_id' => 'required|exists:categories,id',
		]);
		$cat = new Category();
		$cat->name = $request->name;
		$cat->description = $request->description;
		$cat->advice = $request->advice;
		$cat->parent()->associate($request->parent_id);
		$cat->save();
		return redirect()
				->route('categories.show',$cat->id)
				->withMessage('Category '.$cat->name.' Added Successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return view('categories.show', ['category' => Category::findOrFail($id)]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		return view('categories.edit', ['category' => Category::findOrFail($id)]);
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
		$this->validate($request, [
			'name' => 'required|max:255',
			'description' => 'required|max:1000',
			'advice' => 'required|max:1000',
			'parent_id' => ['required', Rule::exists('categories','id')->whereNot('id', $id)],
		]);
		$cat = Category::findOrFail($id);
		$cat->name = $request->name;
		$cat->description = $request->description;
		$cat->advice = $request->advice;
		$cat->parent()->associate($request->parent_id);
		$cat->save();
		return redirect()
				->route('categories.show', $cat->id)
				->withMessage('Category '.$cat->name.' Edited Successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$cat = Category::findOrFail($id);
		$cat->delete();
		return redirect()
				->route('categories.browse',$cat->parent_id)
				->withMessage('Category '.$cat->name.' Deleted Successfully');
	}
}
