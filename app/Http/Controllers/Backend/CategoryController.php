<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Category;

use Image;
use File;


class CategoryController extends Controller
{
  public function __construct()
   {
       $this->middleware('auth:admin');
   }

 public function index()
    {
       $categories=Category :: orderBy('id','desc')->get();
         return view('admin.pages.category.index')->with('categories',$categories);
    }

    public function create(){
      $main_categories=Category :: orderBy('name','desc')->where('parent_id',NULL)->get();
      return view('admin.pages.category.create',compact('main_categories'));

    }

    public function store(Request $request)
    {
      $this->validate($request,[
         'name'   =>'required|max:150',
         'image'  =>'nullable|image',




      ],

        [
         'name.required'=>'Please provide a category name',
         'image.image'=>'Please provide a valid image with .jpg .png .tiff .jpeg extensions',
        ]);



        $category=new Category();
        $category->name=$request->name;
        $category->description=$request->description;
        $category->parent_id=$request->parent_id;

           //Inserting image
           if($request->hasFile('image')){
           $image=$request->file('image');
           $img=time().'.'.$image->getClientOriginalExtension();
           $location =public_path('images/categories/'.$img);
           Image::make($image)->save($location);
           $category->image=$img;
}
           $category->save();



        session()->flash('success','A new category has added successfully!!!!!');
        return redirect()->route('admin.categories');


  }

  public function edit($id)
  {
    $main_categories=Category :: orderBy('name','desc')->where('parent_id',NULL)->get();
    $category=Category :: find($id);
    if(!is_null($category)){
        return view('admin.pages.category.edit',compact('category','main_categories'));
    }
    else
    {
        return redirect()->route('admin.categories');
    }

  }

  public function update(Request $request,$id)
    {
        $request->validate([
         'name'   =>'required|max:150',
         'image'  =>'nullable|image',

        ],

        [
         'name.required'=>'Please provide a category name',
         'image.image'=>'Please provide a valid image with .jpg .png .tiff .jpeg extensions',
        ]);
        $category=Category::find($id);
        $category->name=$request->name;
        $category->description=$request->description;
        $category->parent_id=$request->parent_id;

           //Inserting image
           if($request->hasFile('image')){
            //Delete old image
            if(File::exists('images/categories/'.$category->image)){
                File::delete('images/categories/'.$category->image);
            }
           $image=$request->file('image');
           $img=time().'.'.$image->getClientOriginalExtension();
           $location =public_path('images/categories/'.$img);
           Image::make($image)->save($location);
           $category->image=$img;
           }
           $category->save();
           session()->flash('success','A new category has added successfully!!!!!');
           return redirect()->route('admin.categories');
       }

     public function delete($id)
     {
        $category=Category :: find($id);
         if(!is_null($category)){
        //If it is parent category ,then delete all its sub category..
        if($category->parent_id == NULL)
        {
            $sub_category=Category :: orderBy('name','desc')->where('parent_id',$category->id)->get();
            foreach ($sub_category as $sub) {
                if(File::exists('images/categories/'.$sub->image)){
                   File::delete('images/categories/'.$sub->image);
                }
               $sub->delete();
            }

        }
        //delete category image
        if(File::exists('images/categories/'.$category->image)){
          File::delete('images/categories/'.$category->image);
                }
        $category->delete();
     }
    session()->flash('success','Categories has deleted successfully!!!');
    return back();
   }

}
