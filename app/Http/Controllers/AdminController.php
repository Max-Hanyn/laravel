<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){

        return view('admin.admin',['users' => User::with('roles')->get()]);
    }
    public function show($id){
        $user = User::find($id);

        if (!is_null($user)){
            return view('admin.edit',['user' => $user]);
        }else {
            abort(404);

        }

    }
    public function edit(Request $request,$id){

        $user = User::find($id);

        if (!is_null($user)) {
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
        }else {
            abort(404);
        }
    }



}
