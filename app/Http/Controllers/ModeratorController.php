<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;


class ModeratorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(){
        return view('moderator.moderator',['users' => User::with('roles')->get()]);

    }
    public function verify(Request $request){
        $user = User::find($request->id);

        if ($user->markEmailAsVerified()){
            event(new Verified($user));
        }

       return back();

    }
}
