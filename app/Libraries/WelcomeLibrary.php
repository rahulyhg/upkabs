<?php
namespace App\Libraries;

/**
 * User API
 */
class WelcomeLibrary
{
	public static $API_URL = "https://api.upkabs.com/models/user-api.php";

	// Check Login Session
	public static function checkLoginSession($id, $token)
	{
		// Access API
		$ch = curl_init(self::$API_URL."/".$id."/check/");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$token));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}
}
