<?php
namespace App\Libraries;

/**
 * User API
 */
class PostLibrary
{
	public static $API_URL = "https://api.upkabs.com/models/post-api.php";
	public static $MEDIA_URL = "https://api.upkabs.com/storage/media/";

	// Get Data All Posts
	public static function getAllPosts($page)
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

	// Get Data All Hot Posts
	public static function getAllHotPosts($page)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/hot/'.$page);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Get All Data Most Category Posts
	public static function getCategoryPosts($category, $page)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/category/'.$category.'/posts/'.$page);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Get Data All Posts Order By Number Of Comment
	public static function getMostCommentedPosts($page)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/commented/'.$page);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Get Data All Posts Order By Number Of Up
	public static function getMostUppedPosts($page)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/upped/'.$page);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Get Data All Category Order By Number Of Posts
	public static function getMostCategory($page)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/category/'.$page);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Get Data All Categories
	public static function getAllCategories($page)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/category/all');
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Get User's Posts
	public static function getUserPosts($id, $page)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/user/'.$id.'/'.$page);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Get Single Post Detail
	public static function getSinglePost($id)
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

	// Create Post
	public static function createPost($params, $token)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/post');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$token));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Upload Image
	public static function uploadMedia($uploadRequest, $token)
	{
		$ch= curl_init(self::$API_URL.'/post/uploadmedia');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$token));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $uploadRequest);
		$response = curl_exec($ch);
		curl_close($ch);
		
		$response = json_decode($response, true);

		return $response;
	}

	// Update Post
	public static function updatePost($params)
	{
		// Access API
		$ch = curl_init(self::$API_URL.'/post/'.$id);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);

		return $response;
	}

	// Update Post
	public static function deactivePost($params, $token)
	{
		// Access API
		$ch = curl_init(self::$API_URL);
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
