<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;
use App\Models\ProductImage;
use Auth;
use Image;
use File;
class PostController extends Controller
{



    public function index()

    {

    	$posts= Post::orderBy('id','desc')->get();
    	return view('Frontend.pages.posts.index ',compact('posts'));
    }

    public function my()

    {
      $user = Auth::user();
      $posts= Post::where('user_id',Auth::id())->get();
      return view('Frontend.pages.posts.post ',compact('posts'));
    }

    public function create(){

        return view('frontend.pages.posts.create');

    }


    public function store(Request $request){

     $request->validate([
          'title'   =>'required|max:150',
          'description'  => 'required',
          'price'   =>  'required|numeric',
          'quantity' => 'required|numeric',
          'category_id'=> 'required',
            'user_phone_no' => 'required',
            'source_stoppage'  => 'required',

            'source_division_id'  => 'required',
            'destination_stoppage'  => 'required',

            'destination_division_id'  => 'required',

       ]);

    $post= new Post;
    $post->title=$request->title;
    $post->description=$request->description;
    $post->price=$request->price;
    $post->quantity=$request->quantity;
    $post->weight=$request->weight;

    $post->slug= Str::slug($request->title);
    $post->category_id=$request->category_id;
    $post->user_id=Auth::id();
    $post->user_phone_no=$request->user_phone_no;
      $post->user_email=$request->user_email;
    $post->source_stoppage = $request->source_stoppage;

    $post->source_district_id = $request->source_district_id;
    $post->source_division_id = $request->source_division_id;

    $post->destination_stoppage = $request->destination_stoppage;

    $post->destination_district_id = $request->destination_district_id;
    $post->destination_division_id = $request->destination_division_id;

    $post->save();


    if(count($request->product_image)>0){
       foreach ($request->product_image as $image) {
         if($request->hasFile('product_image'))
    {
     // Insert that Image
     //$image=$request->file('product_image');
     $img=time().'.'.$image->getClientOriginalExtension();
     $location =public_path('images/products/'.$img);
     Image::make($image)->save($location);

     $product_image=new ProductImage;
     $product_image->post_id=$post->id;
     $product_image->image=$img;
     $product_image->save();
       }

    }
}
return redirect()->route('post.create');
 }


   public function show($slug)
      {
         $post=Post::where('slug',$slug)->first();
         //$product=Product::find($slug);
         if(!is_null($post)){
           return view('Frontend.pages.posts.show',compact('post'));
         }
         else{
           session()->flash('errors','Sorry!! There is no Post in this URL..');
           return redirect()->route('posts');
         }
        }


        public function update(Request $request,$id){


          $request->validate([
               'title'   =>'required|max:150',
               'description'  => 'required',
               'price'   =>  'required|numeric',
               'quantity' => 'required|numeric',
               'category_id'=> 'required',
                'brand_id'=> 'required',
                 'user_phone_no' => 'required',
                 'source_stoppage'  => 'required',

                 'source_division_id'  => 'required',
                 'destination_stoppage'  => 'required',

                 'destination_division_id'  => 'required',

            ]);

         $post=Post::find($id);
         $post->title=$request->title;
         $post->description=$request->description;
         $post->price=$request->price;
         $post->quantity=$request->quantity;
         $post->weight=$request->weight;

         $post->slug= Str::slug($request->title);
         $post->category_id=$request->category_id;
         $post->brand_id=$request->brand_id;
         $post->user_id=Auth::id();
         $post->user_phone_no=$request->user_phone_no;
         $post->user_email=$request->user_email;
         $post->source_stoppage = $request->source_stoppage;

         $post->source_district_id = $request->source_district_id;
         $post->source_division_id = $request->source_division_id;

         $post->destination_stoppage = $request->destination_stoppage;

         $post->destination_district_id = $request->destination_district_id;
         $post->destination_division_id = $request->destination_division_id;

         $post->save();


         if(count($request->product_image)>0){
            foreach ($request->product_image as $image) {
              if($request->hasFile('product_image'))
         {
          // Insert that Image
          //$image=$request->file('product_image');
          $img=time().'.'.$image->getClientOriginalExtension();
          $location =public_path('images/products/'.$img);
          Image::make($image)->save($location);

          $product_image=new ProductImage;
          $product_image->post_id=$post->id;
          $product_image->image=$img;
          $product_image->save();
            }

         }
     }
         return redirect()->route('post.show');

        }

        public function delete($id){
          $post=Post :: find($id);
          $product_image=ProductImage::where('post_id',$id)->get();
          if(!is_null($post)){

            $post->delete();
          }

          session()->flash('success','Post has deleted successfully!!!');
          return back();
       }


 }
