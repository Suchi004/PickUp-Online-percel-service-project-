<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Image;
use File;


class SliderController extends Controller
{
  public function __construct()
   {
       $this->middleware('auth:admin');
   }
     public function index()
    {
       $sliders=Slider :: orderBy('priority','asc')->get();
        return view('admin.pages.slider.index',compact('sliders'));
    }



    public function store(Request $request)
    {
      $this->validate($request,[
         'title'   =>'required|max:150',
         'image'   =>'required|image',
         'priority'  =>'required',
         'button_link' => 'nullable|url'
],

        [
         'title.required'=>'Please provide a title',
         'priority.required'=>'Please provide priority',
         'image.image'=>'Please provide a image',
        ]);

        $slider=new Slider();
        $slider->title=$request->title;
        $slider->priority=$request->priority;
        $slider->button_text=$request->button_text;
        $slider->button_link=$request->button_link;
        if($request->image >0){
          $image=$request->file('image');
          $img=time().'.'.$image->getclientOriginalExtension();
          $location=public_path('images/sliders/'.$img);
          Image::make($image)->save($location);
          $slider->image=$img;
        }

        $slider->save();
        session()->flash('success','A new slider has added successfully!!!!!');
        return redirect()->route('admin.sliders');


  }
  public function update(Request $request,$id)
    {
        $request->validate([
          'title'   =>'required|max:150',
          'priority'  =>'required',
          'button_link' => 'nullable|url'

        ],

        [
         'title.required'=>'Please provide a title',
         'priority.required'=>'Please provide priority',
        ]);
        $slider=Slider::find($id);
        $slider->title=$request->title;
        $slider->priority=$request->priority;
        $slider->button_text=$request->button_text;
        $slider->button_link=$request->button_link;
        if($request->image >0){
          $image=$request->file('image');
          $img=time().'.'.$image->getclientOriginalExtension();
          $location=public_path('images/sliders/'.$img);
          Image::make($image)->save($location);
          $slider->image=$img;
        }

        $slider->save();
        session()->flash('success','A new slider has added successfully!!!!!');
        return redirect()->route('admin.sliders');
       }



     public function delete($id)
     {
        $slider=Slider :: find($id);
        if(!is_null($slider)){
          if(File::exists('images/sliders/'.$slider->image))
          {
            File::delete('images/sliders/'.$slider->image);
          }
          $slider->delete();
        }

        session()->flash('success','Slider has deleted successfully!!!');
        return back();
     }

   }
