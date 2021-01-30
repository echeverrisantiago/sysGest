<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tasks = DB::table('tasks')->get()->where('user','=',Auth::user()->id);

        return view('home',compact('tasks',$tasks));
    }

    public function taskAdd($data, Request $req)
    {
        $data = json_decode($data,true);
        $tasks = new Tasks;
        $tasks->name = $data['name'];
        $tasks->description = $data['description'];
        $tasks->state = $data['state'];
        $tasks->dateSTART = $data['dateSTART'];
        $tasks->dateEND = $data['dateEND'];
        $tasks->user = Auth::user()->id;
        $tasks->save();

        return $data;
    }

    public function taskEdit($data, Request $req)
    {
        $data = json_decode($data,true);
        $tasks = Tasks::findOrFail($data['id']);
        $tasks->name = $data['name'];
        $tasks->description = $data['description'];
        if(isset($data['state'])){
        $tasks->state = $data['state'];
        }
        $tasks->dateSTART = $data['dateSTART'];
        $tasks->dateEND = $data['dateEND'];
        $tasks->update();

        return $data;
    }

    public function taskDelete($data, Request $req)
    {
        $tasks = Tasks::findOrFail($data);
        $tasks->delete();

        return $tasks;
    }
}
