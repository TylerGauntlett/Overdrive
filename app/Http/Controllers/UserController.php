<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('user.edit')->with('user', $user);
    }

    public function update(Request $request)
    {

        $user = Auth::user();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user->update($request->all());

        \Session::flash('flash_message', "Update Successful.");

        return redirect()->action('UserController@edit');
    }

}
