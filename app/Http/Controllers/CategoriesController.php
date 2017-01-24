<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
                ->route('categories.index')
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
                ->route('categories.index')
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
        return 'Not implemented yet!';
    }
}
