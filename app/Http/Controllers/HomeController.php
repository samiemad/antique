<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Comment;
use App\Image;
use App\Location;
use App\Category;
use App\Status;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('created_at', 'desc')->get();

        return view('home', ['items'=>$items]);
    }

    public function getPublish(){
        return view('publish', [
            'categories' => Category::all(),
            'locations' => Location::all(),
        ]);
    }

    public function postPublish(Request $request){
        $this->validate($request, [
            'name' => 'required|max:100',
            'description' => 'required|max:1000',
            'price' => 'required',
            'category' => 'required|exists:categories,id',
            'location' => 'required|exists:locations,id',
            'phone' => 'min:10'
        ]);
        
        $item = new Item();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        if($request->phone!=null)
            $item->phone = $request->phone;
        else
            $item->phone = Auth::user()->phone;

        $item->status()->associate(Status::where('name','active')->first());
        $item->category_id = $request->category;
        $item->location_id = $request->location;
        $item->ends_at = \Carbon\Carbon::now()->addDays(5);

        if(Auth::user()->items()->save($item)){
            return redirect('/item/'.$item->id);
        }
        return redirect()->back();
    }

    public function getItem($item_id){
        $item = Item::find($item_id);
        if($item==null){
            return abort(404,'item not found');
        }
        return view('item', ['item' => $item]);
    }

    public function postAddImage(Request $request, $item_id){
        $item = Item::find($item_id);
        if($item==null){
            return abort(404,'item not found');
        }
        $this->validate($request, [
            'image'=> 'required|image|max:10000'
        ]);

        $path = $request->image->store('public/item-images');

        $image = new Image();
        $image->path = $path;
        $item->images()->save($image);

        return redirect()->back();
    }

    public function postAddComment(Request $request, $item_id){
        $item = Item::find($item_id);
        if($item==null){
            return abort(404,'item not found');
        }
        $this->validate($request, [
            'text'=> 'required|max:1000'
        ]);

        $comment = new Comment();
        $comment->text = $request->text;
        $comment->status_id = 1;
        $comment->user_id = Auth::user()->id;
        $item->comments()->save($comment);

        return redirect()->back();
    }
}
