<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\District;

class DistrictController extends Controller
{

  public function __construct()
   {
       $this->middleware('auth:admin');
   }
     public function index()
    {
    	$divisions=Division :: orderBy('priority','asc')->get();
          $districts=District :: orderBy('id','asc')->get();

        return view('admin.pages.district.index',compact('divisions','districts'));
    }

    public function create(){
      $divisions=Division :: orderBy('priority','asc')->get();
      return view('admin.pages.district.create',compact('divisions'));

    }

    public function store(Request $request)
    {
      $this->validate($request,[
         'name'   =>'required|max:150',
         'division_id'  =>'required',




      ],

        [
         'name.required'=>'Please provide a district name',
         'division_id.required'=>'Please provide a division',
        ]);



        $district=new District();
        $district->name=$request->name;
        $district->division_id=$request->division_id;
        $district->save();



        session()->flash('success','A new division has added successfully!!!!!');
        return redirect()->route('admin.districts');


  }

      public function edit($id)
    {
     $divisions=Division :: orderBy('priority','asc')->get();
     $district=District :: find($id);
     return view('admin.pages.district.edit',compact('district','divisions'));
    }

  public function update(Request $request,$id)
    {
        $request->validate([
         'name'   =>'required|max:150',
         'division_id'  =>'required',

        ],

        [
         'name.required'=>'Please provide a category name',
          'division_id.required'=>'Please provide a division ',
        ]);
        $district=District::find($id);
        $district->name=$request->name;
        $district->division_id=$request->division_id;
        $district->save();
        session()->flash('success','A new district has added successfully!!!!!');
        return redirect()->route('admin.districts');
       }

     public function delete($id)
     {
        $district=District :: find($id);
         if(!is_null($district)){

          $district->delete();
     }
    session()->flash('success','divisions has deleted successfully!!!');
    return back();
   }
}
