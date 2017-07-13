<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use App\Libraries\UserLibrary;
use Session;
use Mail;

class UserAPIController extends BaseController
{
	// Seacrh User
	public function getAllUsers($page) 
	{
		// Get Response JSON From User Library
		$response = UserLibrary::getAllUsers($page);

		// Render Response As A Array
		$response_rendered = [
			'users' => $response['data'],
			'total' => $response['total']['users'],
			'avatar_url' => UserLibrary::$AVATAR_URL
		];

		// Return Response For Ajax
		return $response_rendered;
	}

	// Get Data All User
	public function searchUser($page, $search_keyword) 
	{
		// Get Response JSON From User Library
		$response = UserLibrary::searchUser($page, $search_keyword);

		// Render Response As A Array
		$response_rendered = [
			'users' => $response['data'],
			'total' => $response['total']['users'],
			'avatarUrl' => UserLibrary::$AVATAR_URL
		];

		// Return Response For Ajax
		return $response_rendered;
	}

	// Get Single Users Data
	public function getSingleUser($id) 
	{
		// Id Logged In User
		$id_logged_in_user = Session::get('id');

		// If Get Logged In User Got To getMyProfile
		if ($id == $id_logged_in_user) {
			return $this->getMyProfile();
		} else {		
			// Access API
			$response = UserLibrary::getSingleUser($id);

			// Render Response As A Array
			$response_rendered = [
				'user' => $response['data'][0],
				'avatar_url' => UserLibrary::$AVATAR_URL
			];

			// Load view and pass response
			return view('profile', $response_rendered);
		}
	}

	// Get My Profile Data
	public function getMyProfile() 
	{
		// Access API
		$response = UserLibrary::getSingleUser(Session::get('id'));

		// Render Response As A Array
		$response_rendered = [
			'user' => $response['data'][0],
			'avatar_url' => UserLibrary::$AVATAR_URL
		];

		// Load view and pass response
		return view('my-profile', $response_rendered);
	}

	// Get Single Users At Page User Profile
	public function updateUserProfileView() 
	{
		// Access API
		$response = UserLibrary::getSingleUser(Session::get('id'));

		// Render Response As A Array
		$response_rendered = [
			'user' => $response['data'][0],
			'avatar_url' => UserLibrary::$AVATAR_URL
		];

		// Load view and pass response
		return view('edit-profile', $response_rendered);
	}

	// Update User Profile
	public function updateUserProfile(Request $request) 
	{
		// Set Variable
		$id = Session::get('id');
		$name = $request->input('name');
		$gender = $request->input('gender');
		$website = $request->input('website');
		$bio = $request->input('bio');
		$position = $request->input('position');
		$phone = $request->input('phone');
		$token = Session::get('token');
		
		//Set Name Session
		Session::put('name', $name);

		// Check Plain Text or With Image
		if ($request->file('avatar')) {
			$fileName = $request->file('avatar');
			$fileType = $fileName->getClientOriginalExtension();

			// Naming avatar
			$avatar = base64_encode($name);
			
			// Set Avatar Session
			Session::put('avatar', 'https://api.upkabs.com/storage/avatar/'.$avatar.".".basename($fileType));

			// Parameter To Be Passed To Api
			$params = array(
				'name' => $name,
				'gender' => $gender,
				'website' => $website,
				'avatar' => $avatar.".".basename($fileType),
				'bio' => $bio,
				'position' => $position,
				'phone' => $phone
			);

			// Access API
			$response = UserLibrary::updateUserProfile($id, $params, $token);

			// Upload media
			$uploadRequest = array(
				'fileData' => base64_encode(file_get_contents($fileName)),
				'fileType' => basename($fileType),
				'fileRename' => $avatar
			);

			// Get Response JSON From Post Library
			$error_upload = UserLibrary::uploadAvatar($uploadRequest, $token);

			// Unlink fileName
			unlink($fileName);
		} else {
			// Parameter To Be Passed To Api
			$params = array(
				'name' => $name,
				'gender' => $gender,
				'website' => $website,
				'avatar' => 'no-avatar.png',
				'bio' => $bio,
				'position' => $position,
				'phone' => $phone
			);

			// Access API
			$response = UserLibrary::updateUserProfile($id, $params, $token);
		}
		
		// Check Error
		if ($response['error'] == 0) {
			// Redirect To A Page
			return redirect('profile');
		} else {
			return redirect('');
		}
	}

	// Update User Profile
	public function updateUserPassword(Request $request) 
	{
		// Set Variable
		$current_password = $request->input('current_password');
		$new_password = $request->input('new_password');
		$token = Session::get('token');
		$id = Session::get('id');

		$params = array(
			'current_password' => $current_password,
			'new_password' => $new_password,
		);

		// Access API
		$response = UserLibrary::updateUserPassword($id, $params, $token);

		// Return Response
		return $response;
	}

	// Delete User
	public function deactiveUser() 
	{
		// Set Variable
		$id = Session::get('id');
		$token = Session::get('token');

		// Parameter to be passed to API
		$params = array(
			'user' => $id
		);

		$response = UserLibrary::deactiveUser($params, $token);

		if ($response['error'] == 0) {
			// Token Revoked If Deactive Is Success
			Session::flush();
		}
		
		// Redirect To A Page
		return redirect('');
	}

	// Signup
	public function signup(Request $request) 
	{
		// Make Random Combination String
		$random_str = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);

		// Set Variable For Database
		$email = $request->input('email_');
		$name = strstr($email, '@', true);
		$password = $random_str;     

        	// Parameter To Be Passed To Api
		$params = array(
			'email' => $email,
			'password' => md5($password),
			'name' => $name,
		);

		// Get Response JSON From User Library
		$response = UserLibrary::signup($params);
		
		if ($response['error'] == 0) {
			// Data For Email
	        $data = array(
	            'email' => $email,
	            'password' => $password,
	        );
	
	        // Sending Email
	        Mail::send('email-signup', $data, function ($message) use ($email)
	        {	
	            $message->from('care.upkabs@gmail.com', 'Upkabs Team Indonesia');
	
	            $message->to($email)->subject('News from Upkabs Team Indonesia');	
	        });
		    if (Mail::failures()) {
		       	// Return A View
				return view('email-failed');
			} else {
				// Return A View
				return view('email-success');
			}			
		} else {
			return view('email-failed');
		}
	}

	// Forgot Password
	public function forgotPassword(Request $request) 
	{
		// Make Random Combination String
		$random_str = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);

		// Set Variable For Database
		$email = $request->input('email_');
		$name = strstr($email, '@', true);
		$password = $random_str;     

        	// Parameter To Be Passed To Api
		$params = array(
			'email' => $email,
			'password' => md5($password),
			'name' => $name,
		);

		// Get Response JSON From User Library
		$response = UserLibrary::forgotPassword($params);
		
		if ($response['error'] == 0) {
			// Data For Email
	        $data = array(
	            'email' => $email,
	            'password' => $password,
	        );
	
	        // Sending Email
	        Mail::send('email-signup', $data, function ($message) use ($email)
	        {	
	            $message->from('care.upkabs@gmail.com', 'Upkabs Team Indonesia');
	
	            $message->to($email)->subject('News from Upkabs Team Indonesia');	
	        });
		    if (Mail::failures()) {
		       	// Return A View
				return view('email-failed');
			} else {
				// Return A View
				return view('email-success');
			}			
		} else {
			return view('email-failed');
		}
	}

	// Signin
	public function signin(Request $request) 
	{
		// Set Variable
		$email = $request->input('email');
		$password = $request->input('password');
		$ip = $request->getClientIp();
		$user_agent = $request->header('User-Agent');

		// Parameter To Be Passed To Api
		$params = array(
			'email' => $email,
			'password' => $password,
			'ip' => $ip,
			'user_agent' => $user_agent
			);
		
		// Get Response JSON From User Library
		$response = UserLibrary::signin($params);

		// Check Response
		if ($response['error'] == 0) {
			// Set token
			Session::put('token', $response['token']);
			Session::put('id', $response['data'][0]['id']);
			Session::put('name', $response['data'][0]['name']);
			Session::put('avatar', 'https://api.upkabs.com/storage/avatar/'.$response['data'][0]['avatar']);

			return $response;
		}
	}

	// Signout
	public function signout() 
	{
		// Set Variable
		$token = Session::get('token');
		$id = Session::get('id');

		// Parameter To Be Passed To Api
		$params = array(
			'token' => $token,
			'id' => $id
		);
		
		// Get Response JSON From User Library
		$response = UserLibrary::signout($params);       

		// Token Revoked If Logout Is Success
		Session::flush();

		// Redirect To A Page
		return redirect('/');
	}
}
