<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Search;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        $user = User::where('id', '=', $id)->get();
        $skills = Search::where('bind_id','=',$id)->where('state','=','1')->where('type','=','talent')->get();
        $skill_list=array();
        foreach($skills as $skill){
            array_push($skill_list,$skill->skill_id);
        }
        $skill_names=["1"=>"C","2"=>"C++","3"=>"PHP","4"=>"Python","5"=>"JavaScript","6"=>"Go","7"=>"Ruby","8"=>"Rust"];
        return view('user.index', compact('user','id','skill_list','skill_names'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return $user->name;
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::where('id', '=', $id)->get()[0];
        $skills = Search::where('bind_id','=',$id)->where('state','=','1')->where('type','=','talent')->get();
        $skill_list=array();
        foreach($skills as $skill){
            array_push($skill_list,$skill->skill_id);
        }
        $skill_names=["1"=>"C","2"=>"C++","3"=>"PHP","4"=>"Python","5"=>"JavaScript","6"=>"Go","7"=>"Ruby","8"=>"Rust"];
        return view('user.edit', compact('user','id','skill_list','skill_names'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('id', '=', Auth::user()->id)->get()[0];
        $user->update($validated);
        return redirect()->route('user',Auth::user()->id)->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
