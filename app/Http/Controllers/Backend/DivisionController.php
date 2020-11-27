<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\District;

class DivisionController extends Controller
{
  public function __construct()
   {
       $this->middleware('auth:admin');
   } 
     public function index()
    {
       $divisions=Division :: orderBy('priority','asc')->get();
        return view('admin.pages.division.index',compact('divisions'));
    }

    public function create(){

      return view('admin.pages.division.create');

    }

    public function store(Request $request)
    {
      $this->validate($request,[
         'name'   =>'required|max:150',
         'priority'  =>'required',




      ],

        [
         'name.required'=>'Please provide a division name',
         'priority.required'=>'Please provide division priority',
        ]);



        $division=new Division();
        $division->name=$request->name;
        $division->priority=$request->priority;
        $division->save();



        session()->flash('success','A new division has added successfully!!!!!');
        return redirect()->route('admin.divisions');


  }

      public function edit($id)
    {
     $division=Division :: find($id);
     return view('admin.pages.division.edit',compact('division'));
    }

  public function update(Request $request,$id)
    {
        $request->validate([
         'name'   =>'required|max:150',
         'priority'  =>'required',

        ],

        [
         'name.required'=>'Please provide a category name',
          'priority.required'=>'Please provide division priority',
        ]);
        $division=Division::find($id);
        $division->name=$request->name;
        $division->priority=$request->priority;
        $division->save();
        session()->flash('success','A new division has added successfully!!!!!');
        return redirect()->route('admin.divisions');
       }

     public function delete($id)
     {
        $division=Division :: find($id);
         if(!is_null($division)){
            //delete all districts
           $districts=District::where('division_id',$division->id)->get();
           foreach($districts as $district){
            $district->delete();
           }
          $division->delete();
     }
    session()->flash('success','divisions has deleted successfully!!!');
    return back();
   }
}
