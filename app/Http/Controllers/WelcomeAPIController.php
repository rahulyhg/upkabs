<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use App\Libraries\WelcomeLibrary;
use Session;


class WelcomeAPIController extends BaseController
{
	// Seacrh User
	public function checkLoginSession() 
	{		
		// Check Session Is Availabel Or Not
		if (Session::has('token') && Session::has('id')) {
			// Set Variable
			$token = Session::get('token');
			$id = Session::get('id');
			
			// Get Response JSON From User Library
			$response = WelcomeLibrary::checkLoginSession($id, $token);
						
			// Check Token is Active Or Deactive
			if ($response['error'] == 0) {
				return redirect('timeline');	
			} else {
				return view('welcome');
			}
		} else {
			return view('welcome');
		}
	}
}
