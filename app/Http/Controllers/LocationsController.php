<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
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
        return view('locations.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function browse($id = 1)
    {
        return view('locations.browse', ['location'=>Location::findOrFail($id)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = 1)
    {
        return view('locations.create',['id'=>$id]);
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
            'parent_id' => 'required|exists:locations,id',
        ]);
        $loc = new Location();
        $loc->name = $request->name;
        $loc->parent()->associate($request->parent_id);
        $loc->main = true;
        $loc->save();
        return redirect()
                ->route('locations.show',$loc->id)
                ->withMessage('Location '.$loc->name.' Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('locations.show', ['location'=> Location::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('locations.edit',['location'=> Location::findOrFail($id)]);
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
            'parent_id' => 'required|exists:locations,id',
            'main' => 'boolean',
        ]);
        $loc = Location::findOrFail($id);
        $loc->name = $request->name;
        $loc->parent()->associate($request->parent_id);
        $loc->main = $request->main?true:false;
        $loc->save();
        return redirect()
                ->route('locations.show',$loc->id)
                ->withMessage('Location '.$loc->name.' Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $loc = Location::findOrFail($id);
       $loc->delete();
       return redirect()
            ->route('locations.browse',$loc->parent_id)
            ->withMessage('Location '.$loc->name.' Deleted Successfully');
    }
}
