<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Session;
use Input;

class UserController extends Controller
{
    public function login(Request $request)
    {
    	 if ($request->isMethod('post')) {
    	 	//validation rules
            $rules = array(             
                'email' => 'required|Regex:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/',  
                'password' => 'required', 
            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Redirect::to('login')
                                ->withErrors($validator)
                                ->withInput();
            }else{
            	$data = $request->input();
	            if (Auth::attempt(['email' =>	 $data['email'], 'password' => $data['password']])) {
	                $userData = User::where(['email' => $data['email']])->first();
	                return redirect('/products');
	            } else {
	                return redirect('/')->with('flash_message_error', 'Invalid Email or Password.');
	            }
        	}
        }
        return view('login');
    }
    public function logout() {
        Session::flush();
        return redirect('/')->with('flash_message_success', 'Logged out successfully.');
    }
    public function register(Request $request)
    {
            //validation rules
            $rules = array(             
                'name' => 'required',    
                'email' => 'required|Regex:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/|unique:users',  
                'password' => 'required', 
            );
            $validator = Validator::make(Input::all(), $rules);

            // if validation fails
            if ($validator->fails()) {
                return Redirect::to('register')
                                ->withErrors($validator)
                                ->withInput();
            } else {
                //store
                $user = new User;
                $user->name = Input::get('name');
                $user->email = Input::get('email');
                $user->password = Hash::make(Input::get('password'));
                $user->save();

                // redirect
                Session::flash('flash_message_success', 'Account created successfully!');
                return Redirect::to('/login');
            }
    }

    public function page401(Request $request)
    {
        return view('401');
    }
}
