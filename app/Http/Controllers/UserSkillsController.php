<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\user_skills;
use Illuminate\Support\Facades\Auth;
use Response;
class UserSkillsController extends Controller
{
    public function show($id){

        $user = User::find($id);
        if (!is_null($user)) {
            return view('userProfile.skills', ['user' => $user, 'id' => $id]);
        } else{
            abort(404);
        }
    }
    public function add(Request $request, $id){
        $user = User::find($id);
        if (!is_null($user)) {

            $skill = new user_skills();
            $skill->name = $request->name;
            $skill->level = $request->level;
            $skill->language = $request->language;
            $user->skills()->save($skill);

            return Response::json($skill);

        }else{
            return Response::json(['msg'=>'not found user']);
        }
    }

    public function edit(Request $request, $id){

        $skill = user_skills::find($request->id);

        if (!is_null($skill)) {

            $skill->name = $request->name;
            $skill->level = $request->level;
            $skill->language = $request->language;
            $skill->update();

            return Response::json($skill);

        }else{
            return Response::json(['msg'=>'not found skill']);
        }
    }
    public function delete(Request $request){
        $skill = user_skills::find($request->idToDelete);

        if (!is_null($skill)) {
            $skill->delete();
        }
    }
    public function toSkills(){
        $userId = Auth::user()->id;
        return redirect("profile/$userId/skills");
    }


}
