<?php
namespace App\Libraries;

class UpLibrary
{
	public static $API_URL = "https://api.upkabs.com/models/up-api.php";

	// Get All Post's Ups
	public static function getPostUps($post)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/'.$post);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($response, true);

		return $response;
	}

	// Create Up
	public static function createUp($params)
	{
		// Access API
		$ch = curl_init(self::$API_URL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Delete Up
	public static function deleteUp($post, $up)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/'.$post.'/'.$up);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}
}
