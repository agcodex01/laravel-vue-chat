<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;

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
        return view('home');
    }
    public function profile(User $user)
    {
        return view('profile',compact('user'));
    }
    public function update(Request $request,  User $user)
    {
        if($request->has('profile_image')){
            if(! is_dir(public_path('/images'))){
                mkdir(public_path('/images'),0777);
            }
            $basename = Str::random();
            $original = $basename . '.'. $request->profile_image->getClientOriginalExtension();
            $request->profile_image->move(public_path('/images'),$original);
            $user->update([

                'name'          => $request->name,
                'email'         => $request->email,
                'profile_image' => '/images/'. $original,
            ]);

        }else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }



        return back();
    }


}
