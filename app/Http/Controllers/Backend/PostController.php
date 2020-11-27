<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\ProductImage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts= Post::orderBy('id','desc')->get();
    	return view('admin.pages.post.index ')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($slug)
        {
           $post=Post::where('slug',$slug)->first();
           //$product=Product::find($slug);
           if(!is_null($post)){
             return view('admin.pages.post.show',compact('post'));
           }
           else{
             session()->flash('errors','Sorry!! There is no Post in this URL..');
             return redirect()->route('admin.posts');
           }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
