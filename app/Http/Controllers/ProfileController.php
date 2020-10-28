<?php

namespace App\Http\Controllers;

use App\Images;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified', ]);
    }

    public function profile($id)
    {

        return view('userProfile.profile', ['user' => User::find($id)]);

    }

    public function edit(Request $request)
    {

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'nickname' => 'required|unique:users'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'email or nickname already exist');

        } else {

            $user->name = request('name');
            $user->email = request('email');
            $user->nickname = request('nickname');

            $user->save();

            return back()->with('success', 'successfully changed info');
        }

    }
    public function toProfile(){
        $userId = Auth::user()->id;


        return redirect("/profile/$userId");


    }

    public function addImage(Request $request){


       $imageName = $request->image->store('images','public');
       $user = Auth::user();

       $image = new Images();
       $image->image_name = $imageName;
       $image->image_extension = $request->image->getMimeType();
       $image->is_main = '1';

       $user->images()->save($image);

       return back();

    }

    public static function getAvatar($userId){

      $avatarImage = User::find($userId)->images()->where('is_main', '1')->first();
      return $avatarImage->image_name;

    }
}
