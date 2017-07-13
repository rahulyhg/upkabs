<?php
namespace App\Libraries;

/**
 * User API
 */
class ClickLibrary
{
	public static $API_URL = "https://api.upkabs.com/models/click-api.php";

	// Create Post
	public static function createClick($params, $token)
	{
		// Access API
		$ch = curl_init(self::$API_URL);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$token));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}
}
