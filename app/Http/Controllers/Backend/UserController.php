<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users= User::orderBy('id','desc')->get();
    	return view('admin.pages.user.index ')->with('users',$users);
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

      public function show($id)
         {
            $user=User::where('id',$id)->first();
            //$product=Product::find($slug);
            if(!is_null($user)){
              return view('admin.pages.user.show',compact('user'));
            }
            else{
              session()->flash('errors','Sorry!! There is no Post in this URL..');
              return redirect()->route('admin.users');
            }
           }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user=User :: find($id);
        if(!is_null($user)){

          $user->delete();
        }

        session()->flash('success','User has deleted successfully!!!');
        return back();
     }

}
