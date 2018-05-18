<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\User;

class SessionsController extends Controller
{


    public function __construct()

    {

        $this->middleware('guest', ['except' => 'destroy']);

    }


    public function create()

    {

        return view('sessions.create');

    }


    public function store(Request $request)

    {
        $credentials = $request->only('email', 'password');


        if (!auth()->attempt($credentials)) {

            return back()->withErrors([

                'message' => 'Please check your credentials an try again.'
            ]);
        } else {
            auth()->user()->update(['status' => 'online']);

//        Session::put('user_id', auth()->user());
//        Session::create([
//            'user_id' => $request->auth()->user()->id,
//        ]);
        }

        return redirect()->home();

    }


    public function destroy()

    {
        if (auth()->user()) {
            auth()->user()->update(['status' => 'offline']);

            auth()->logout();

            return redirect('/');
        }

        return redirect('/');

    }


}
