<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
use Redirect;
use Session;

class MainController extends Controller {
	public function login(Request $request) {
		if (Auth::attempt ( array (
				'name' => $request->get ( 'username' ),
				'password' => $request->get ( 'password' ) 
		) )) {
			session ( [ 
					'name' => $request->get ( 'username' ) 
			] );
			return Redirect::back ();
		} else {
			Session::flash ( 'message', "Invalid Credentials , Please try again." );
			return Redirect::back ();
		}
	}
	public function register(Request $request) {
		$user = new User ();
		$user->name = $request->get ( 'username' );
		$user->email = $request->get ( 'email' );
		$user->password = Hash::make ( $request->get ( 'password' ) );
		$user->remember_token = $request->get ( '_token' );
		$user->save ();
		return redirect ( '/' );
	}
	public function logout() {
		Session::flush ();
		Auth::logout ();
		return Redirect::back ();
	}
}
