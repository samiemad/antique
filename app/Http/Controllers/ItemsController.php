<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Image;
use App\Item;
use App\Like;
use App\Liketype;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemsController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware(['auth']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$items = Item::orderBy('created_at', 'desc')->paginate(10);

		return view('items.index', ['items'=>$items]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('items.create');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return view('items.show', ['item' => Item::findOrFail($id)]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		return view('items.edit', ['item' => Item::findOrFail($id)]);
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
			'name' => 'required|max:100',
			'description' => 'required|max:1000',
			'price' => 'required',
			'category_id' => 'required|exists:categories,id',
			'location_id' => 'required|exists:locations,id',
			]);
		
		$item = new Item();
		$item->name = $request->name;
		$item->description = $request->description;
		$item->price = $request->price;

		$item->status()->associate(Status::where('name','active')->first());
		$item->category_id = $request->category_id;
		$item->location_id = $request->location_id;
		$item->phone = 0;
		$item->ends_at = \Carbon\Carbon::now()->addDays(5);

		if(Auth::user()->items()->save($item)){
			return redirect()->route('items.show',$item->id)->withMessage('Item created successfully');
		}
		return redirect()->back()->withMessage('Unable to create item!');
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
			'name' => 'required|max:100',
			'description' => 'required|max:1000',
			'price' => 'required|integer|max:1000000000',
			'category_id' => 'required|exists:categories,id',
			'location_id' => 'required|exists:locations,id',
			]);
		
		$item = Item::findOrFail($id);
		$item->name = $request->name;
		$item->description = $request->description;
		$item->price = $request->price;

		$item->status()->associate(Status::where('name','active')->first());
		$item->category_id = $request->category_id;
		$item->location_id = $request->location_id;

		$item->save();

		return redirect()->route('items.show',$item->id)->withMessage('Item updated successfully');
	}

	public function addComment (Request $request, $id){
		$item = Item::findOrFail($id);
		$this->validate($request, [
			'text'=>'required|max:1000',
			]);
		$comment = new Comment();
		$comment->text = $request->text;
		$comment->status_id = 1;
		$comment->user_id = Auth::user()->id;
		$item->comments()->save($comment);

		return redirect()->back()->withMessage('commented successfully');
	}

	public function deleteComment ($id){
		$comment = Comment::findOrFail($id);
		$comment->delete();
	}

	public function addImage (Request $request, $id){
		$item = Item::findOrFail($id);
		$this->validate($request, [
			'image'=> 'required|image|max:10000'
			]);

		$path = $request->image->store('public/item-images');

		$image = new Image();
		$image->path = $path;
		$item->images()->save($image);

		return redirect()->back()->withMessage('Image added successfully');
	}

	public function deleteImage ($item_id, $image_id){
		$item = Item::findOrFail($item_id);
		$image = Image::findOrFail($image_id);
		Storage::delete($image->path);
		$image->delete();

		return redirect()->back()
		->withMessage('Image deleted');
	}

	public function like (Request $request){
		$item = Item::findOrFail($request->itemid);
		$type = Liketype::where('name',$request->type)->firstOrFail();
		$like = Like::where('item_id',$item->id)
					->where('user_id',Auth::user()->id)
					->first();
		$verb = Str::lower($type->name).'d';
		if($like == null)
		{
			$like = new Like();
			$like->user_id = Auth::user()->id;
			$like->item_id = $item->id;
			$like->liketype_id = $type->id;
			$like->save();
		}else{
			if($like->type->id == $type->id){
				$like->delete();
				$type->name = null;
				$verb = 'un'.$verb;
			}else{
				$like->liketype_id = $type->id;
				$like->save();
			}
		}
		return json_encode([
			'success' => true,
			'message' => 'post '.$verb,
			'liketype' => $type->name,
			]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$item = Item::findOrFail($id);
		foreach($item->images as $image){
			Storage::delete($image->path);
			$image->delete();
		}
		$item->comments()->delete();
		$item->delete();
		return redirect()->route('items.index')
		->withMessage('Item '.$item->name.' deleted successfully');
	}
}
