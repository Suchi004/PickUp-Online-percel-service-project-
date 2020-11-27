<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\UserReview;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;


class UserReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

      $this->validate($request,[
          'user_id'=>'required'],
          [
           'user_id.required'=>'Please give a user.'
          ]);

      $user=Auth::user();
      $review=New UserReview;
      $review->reviewer_id=Auth::id();
      $review->user_id=$request->user_id;
      $review->headline=$request->headline;
      $review->description=$request->description;
      $review->rating=$request->rating;
      $review->save();
      return view('Frontend.pages.users.show',compact('review','user'));
      session()->flash('success','Your Review has been added Successfully!!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserReview  $userReview
     * @return \Illuminate\Http\Response
     */
    public function show(UserReview $userReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserReview  $userReview
     * @return \Illuminate\Http\Response
     */
    public function edit(UserReview $userReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserReview  $userReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserReview $userReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserReview  $userReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserReview $userReview)
    {
        //
    }
}
