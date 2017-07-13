<?php
namespace App\Libraries;

/**
 * User API
 */
class CommentLibrary
{
	public static $API_URL = "https://api.upkabs.com/models/comment-api.php";

	// Get All Comment To User
	public static function getCommentsToUser($user)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/comment/notification/'.$user);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Deactive All Comment To User
	public static function deactiveCommentsToUser($user)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/comment/notification/'.$user);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		$response = curl_exec($ch);
		curl_close($ch);
		// $response = json_decode($response, true);

		return $response;
	}

	// Get All Post's Comments
	public static function getPostComments($post)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/comment/'.$post);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($response, true);

		return $response;
	}

	// Create Comment
	public static function createComment($params)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/comment');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Delete Comment
	public static function deactiveComment($params)
	{
		// Access API
		$ch = curl_init(self::$API_URL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}
}
