<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Redirect;

class EmployeeController extends Controller
{

	public function index() 
	{
		$users = User::where("role",2)->paginate(15);
		return view("page.employee.index",compact("users")); 
	}

	public function destroy($id)
	{
		if($id == 1) 
		{
			return Redirect::back();
		}
		else
		{
			try 
			{
				$user = User::findOrFail($id);
				$user->delete();
				return Redirect::back();
			} 
			catch (\Exception $e) 
			{
				return redirect()->route("employee.index");
			}
		}
	}

   	public function validation_store(array $data)
   	{
   		$messages = [
  	    	'password.required' => 'Please enter current password',
  	    	'userlogin.required' => 'Please enter userlogin',
  	    	'name.required' => 'Please enter name'
  	  	];

   		$validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],$messages);
        return $validator;
   	}

    public function store(Request $data)
    {
    	$request_data = $data->All();
    	$validator = $this->validation_store($request_data);
        if($validator->fails())
    	{
    		return Redirect::back()->withErrors($validator);
    	}
    	else
    	{
    		User::create([
            	'name' => $data['name'],
            	'email' => $data['email'],
            	'password' => bcrypt($data['password']),
            	'role' => 2
        	]);
        	return view('page.employee.index');
    	}
    }

    public function reset($id)
	{
		if($id == 1) 
		{
			return Redirect::back();
		}
		else
		{
			try 
			{
				$user = User::findOrFail($id);
				$user->password = bcrypt('grandeur123');
				$user->save();
				return Redirect::back();
			} 
			catch (\Exception $e) 
			{
				return redirect()->route("employee.index");
			}
		}
	}
}
