<?php
namespace App\Libraries;

/**
 * User API
 */
class UserLibrary
{
	public static $API_URL = "https://api.upkabs.com/models/user-api.php";
	public static $AVATAR_URL = "https://api.upkabs.com/storage/avatar/";

	// Sign Up
	public static function signup($params)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/user/signup');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		$response = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($response, true);

		return $response;
	}

	// Forgot Password
	public static function forgotPassword($params)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/user/forgot_password');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		$response = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($response, true);

		return $response;
	}

	// Sign In
	public static function signin($params)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/user/signin');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Sign Out
	public static function signout($params)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/user/signout');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		$response = curl_exec($ch);
		curl_close($ch);
	}

	// Get List All Users
	public static function getAllUsers($page)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/'.$page);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Get Single User Detail
	public static function getSingleUser($id)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/single/'.$id);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($response, true);

		return $response;
	}

	// Update User Profile
	public static function updateUserProfile($id, $params, $token)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/profile/'.$id);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$token));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		$response = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($response, true);

		return $response;
	}

	// Update User Password
	public static function updateUserPassword($id, $params, $token)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/password/'.$id);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$token));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		$response = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($response, true);

		return $response;
	}

	// Upload Image
	public static function uploadAvatar($uploadRequest, $token)
	{
		$ch = curl_init(self::$API_URL.'/post/uploadavatar');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$token));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $uploadRequest);
		$response = curl_exec($ch);
		curl_close($ch);
		
		//$response = json_decode($response, true);

		return $response;
	}

	// Search User Base On His Name
	public static function searchUser($page, $params)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/'.$page."/search/".$params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Deactive User
	public static function deactiveUser($params, $token)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/deactive');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$token));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}
}
