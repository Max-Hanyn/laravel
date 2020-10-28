<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
class UsersController extends Controller
{


    public function show(){


        return view('users', [
            'users' => User::with('roles')->get(),
            'roles' => Role::all(),
            'isAdmin' => Auth::user()->hasRole('Admin'),
            'isModerator' => Auth::user()->hasRole('Moderator')
        ]);

    }
    public function addRole(Request $request){

        $user  = User::find($request->userId);
        if (!is_null($user)){
        $roles = $request->roles;
        foreach ($roles as $role){
            $user->roles()->attach($role);
        }
        return redirect('/users');
    }else{
            abort(404);
        }
    }

    public function deleteRole(Request $request){

        $user  = User::find($request->userId);

        if (!is_null($user)){

            $user->roles()->detach($request->roleId);
            return redirect('/users');
        }else {

            abort(404);
        }

    }

    public function search(Request $request){

        $search = $request->search;

        $users = User::with('roles')->where('users.name','like',"%$search%")
            ->orWhere('users.nickname','like',"%$search%")
            ->orWhereHas('roles',function ($q) use ($search){
                $q->where('roles.name','like',"%$search%");
            })->orWhereHas('skills', function ($q) use ($search){
                $q->where('user_skills.level','like',"%$search%")
                    ->orWhere('user_skills.language','like',"%$search%")
                    ->orWhere('user_skills.name','like',"%$search%");
            })->get();
        $roles =  Role::all();

        $usersJson = $users->toArray();
        $rolesJson = $roles->toArray();
        return Response::json([$usersJson,$rolesJson]);


    }


}
