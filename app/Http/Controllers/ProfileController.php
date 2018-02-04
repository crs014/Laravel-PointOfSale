<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Redirect;
use Hash;

class ProfileController extends Controller
{
    public function index() 
    {
    	return view('page.profile.index');
    }

    public function admin_credential_rules(array $data)
	  {
  		$messages = [
  	    	'current-password.required' => 'Please enter current password',
  	    	'password.required' => 'Please enter password',
  	  	];

  	  	$validator = Validator::make($data, [
  	    	'current-password' => 'required',
  	    	'password' => 'required|same:password',
  	    	'password_confirmation' => 'required|same:password',     
  	  	], $messages);
	  	return $validator;
	  }

	public function change(Request $request)
	{
  		if(Auth::Check())
  		{
    		$request_data = $request->All();
    		$validator = $this->admin_credential_rules($request_data);
    		if($validator->fails())
    		{
    			return Redirect::back()->withErrors($validator);
      			//return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
    		}
    		else
    		{  
      			$current_password = Auth::User()->password;           
      			if(Hash::check($request_data['current-password'], $current_password))
      			{           
        			$user_id = Auth::User()->id;                       
        			$obj_user = User::find($user_id);
        			$obj_user->password = bcrypt($request_data['password']);;
        			$obj_user->save(); 
        			return redirect('/');
      			}
      			else
      			{           
        			//$error = array('current-password' => 'Please enter correct current password');
        			//return response()->json(array('error' => $error), 400);
        			return Redirect::back()->withErrors($validator);   
      			}
    		}        
  		}
  		else
  		{
    		return redirect()->to('/');
  		}    
	}  
}
