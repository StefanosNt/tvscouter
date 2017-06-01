<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Input as Input;  
use Illuminate\Http\Request; 
use Illuminate\Http\RedirectResponse; 
use App\User; 
use Hash;
use Image;

class UserController extends Controller
{
    //
	
	public function index(){
		
		return view('auth.user-settings');
		
	}	
	
	public function updateInfo(Request $request){
		
		$user = new User;  
		$user->updateInfo(Auth::user()->id,$request);
						   
				
		if($request->get('avatar_path')!==NULL){
		
			$avatar = $request->file('avatar');
			$filename = 'u'. Auth::user()->id. '-'. date('Ymd'). '.'. $avatar->getClientOriginalExtension();
			
			Image::make($avatar)->resize(500,500)->save(storage_path('app/public/'.$filename));
			
			Auth::user()->avatar = $filename;
			Auth::user()->save();
			
		} 
		
		return back()->with('status','Succesfully updated');   
		
	}
	
	public function getUserPasswordReset(){
		
		return view('auth.user-password-reset');
	
	}	
	
	public function passwordReset(){
		
		$user = User::find(Auth::user()->id);
		if(Hash::check(Input::get('password_old'),$user['password']) && Input::get('password') == Input::get('password_confirmation')){
			$user->password = bcrypt(Input::get('password'));
			$user->save();
			return back()->with('status','Success');
		}
		
		return back()->with('status','Something went wrong');
	}
	
	
	
}
