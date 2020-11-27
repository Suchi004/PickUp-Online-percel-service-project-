<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Image;
use File;

class ProductController extends Controller
{
  public function __construct()
   {
       $this->middleware('auth:admin');
   }


   public function create(){

   	return view('admin.pages.product.create');

   }


   public function manage(){
     $products=Product :: orderBy('id','desc')->get();
    return view('admin.pages.product.manage')->with('products',$products);

   }


   public function edit($id){
    $product=Product :: find($id);
    return view('admin.pages.product.edit')->with('product',$product);

   }

   public function store(Request $request){

   	$request->validate([
         'title'   =>'required|max:150',
         'description'  => 'required',
         'price'   =>  'required|numeric',
         'quantity' => 'required|numeric',
         'category_id'=> 'required',
          'brand_id'=> 'required',

   		]);

   $product= new Product;
   $product->title=$request->title;
   $product->description=$request->description;
   $product->price=$request->price;
   $product->quantity=$request->quantity;
   $product->slug= Str::slug($request->title);
   $product->category_id=$request->category_id;
   $product->brand_id=$request->brand_id;
   $product->admin_id=1;
   $product->save();


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
    $product_image-> product_id=$product->id;
    $product_image->image=$img;
    $product_image->save();
   	  }

   }



   }



   return redirect()->route('admin.product.create');

}

       public function update(Request $request, $id){

         $request->validate([
        'title'   =>'required|max:150',
        'description'  => 'required',
        'price'   =>  'required|numeric',
        'quantity' => 'required|numeric',
        'category_id'=> 'required',
          'brand_id'=> 'required',

        ]);

         $product= Product ::find($id);
         $product->title=$request->title;
         $product->description=$request->description;
         $product->price=$request->price;
         $product->quantity=$request->quantity;
         $product->category_id=$request->category_id;
         $product->brand_id=$request->brand_id;

         $product->save();
         return redirect()->route('admin.products');

   }

    public function delete($id){
     $product=Product :: find($id);
     if(!is_null($product)){
     	$product->delete();
     }
    session()->flash('success','Product has deleted successfully!!!');
    return back();
   }
}
