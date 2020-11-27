<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Division;
use App\Models\Slider;
class PagesController extends Controller
{
    public function index()
    {

      $sliders=Slider::orderBy('priority','asc')->get();
    	$posts=Post :: orderBy('id','desc')->paginate(10);
    	return view('Frontend.pages.index',compact('posts','sliders'));
    }
     public function search(Request $request)

    {
    	$search=$request->search;
    	$posts=Post ::orWhere('title','like','%'.$search.'%')
    	->orWhere('description','like','%'.$search.'%')
    	->orWhere('slug','like','%'.$search.'%')
    	->orWhere('price','like','%'.$search.'%')
    	->orWhere('quantity','like','%'.$search.'%')
      ->orWhere('source_stoppage','like','%'.$search.'%')
      ->orWhere('destination_stoppage','like','%'.$search.'%')
      ->orWhere('destination_stoppage','like','%'.$search.'%')
    	->orderBy('id','desc')
    	->paginate(10);
      $divisions=Division::orWhere('name','like','%'.$search.'%')
      ->orderBy('id','desc')
      ->paginate(10);
    	return view('Frontend.pages.posts.search ',compact('search','posts','divisions'));
    }


      public function contact(){
        return view('Frontend.pages.contact');
      }
}
