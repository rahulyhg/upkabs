<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use App\Libraries\PostLibrary;
use App\Libraries\ClickLibrary;
use Session;

class PostAPIController extends BaseController
{
	// Get Data All Post
	public function getAllPosts($page)
	{
		// Get Response JSON From Post Library
		$response = PostLibrary::getAllPosts($page);

		// Render Response As A Array
		$response_rendered = [
			'posts' => $response['data'],
			'total' => $response['total']['posts'],
			'media_url' => PostLibrary::$MEDIA_URL
		];

		// Return Response For Ajax
		return $response_rendered;
	}

	// Get Data All Hot Post
	public function getAllHotPosts($page)
	{
		// Get Response JSON From Post Library
		$response = PostLibrary::getAllHotPosts($page);

		// function quicksort( $array ) {
		// 	if( count( $response['data'] ) < 2 ) {
		//         return $response['data'];
		//     }
		//     $left = $right = array( );
		//     reset( $response['data'] );
		//     $pivot_key  = key( $response['data'] );
		//     $pivot  = array_shift( $response['data'] );
		//     foreach( $response['data'] as $k => $v ) {
		//         if( $v < $pivot )
		//             $left[$k] = $v;
		//         else
		//             $right[$k] = $v;
		//     }
		//     return array_merge(quicksort($left), array($pivot_key => $pivot), quicksort($right));
		// }
		 
		// //Using quicksort()
		// $response['data']  = quicksort( $response['data'] );

		// Render Response As A Array
		$response_rendered = [
			'posts' => $response['data'],
			'total' => $response['total']['posts'],
			'media_url' => PostLibrary::$MEDIA_URL
		];



		// Return Response For Ajax
		return $response_rendered;
	}

	// Get All Data Most Category Posts View
	public function getCategoryPostsView($category)
	{
		// Selected Categroy As A Session
		Session::put('category', $category);

		// Return View
		return view('trending-category-posts');
	}

	// Get All Data Most Category Posts
	public function getCategoryPosts($category, $page)
	{
		// Get Response JSON From Post Library
		$response = PostLibrary::getCategoryPosts($category, $page);

		// Render Response As A Array
		$response_rendered = [
			'posts' => $response['data'],
			'total' => $response['total']['posts'],
			'media_url' => PostLibrary::$MEDIA_URL
		];

		// Return Response For Ajax
		return $response_rendered;
	}

	// Get Data All Post Order By Number Of Comment
	public function getMostCommentedPosts($page)
	{
		// Get Response JSON From Post Library
		$response = PostLibrary::getMostCommentedPosts($page);

		// Render Response As A Array
		$response_rendered = [
			'posts' => $response['data'],
			'total' => $response['total']['posts'],
			'media_url' => PostLibrary::$MEDIA_URL
		];

		// Return Response For Ajax
		return $response_rendered;
	}

	// Get Data All Post Order By Number Of Up
	public function getMostUppedPosts($page)
	{
		// Get Response JSON From Post Library
		$response = PostLibrary::getMostUppedPosts($page);

		// Render Response As A Array
		$response_rendered = [
			'posts' => $response['data'],
			'total' => $response['total']['posts'],
			'media_url' => PostLibrary::$MEDIA_URL
		];

		// Return Response For Ajax
		return $response_rendered;
	}

	// Get Data All Category Order By Number Of Posts
	public function getMostCategory($page)
	{
		// Get Response JSON From Post Library
		$response = PostLibrary::getMostCategory($page);

		// Render Response As A Array
		$response_rendered = [
			'categories' => $response['data'],
			'total' => $response['total']['posts'],
			'media_url' => PostLibrary::$MEDIA_URL
		];

		// Return Response For Ajax
		return $response_rendered;
	}

	// Get Data All Categories
	public function getAllCategories()
	{
		// Get Response JSON From Post Library
		$response = PostLibrary::getAllCategories($page);

		// Render Response As A Array
		$response_rendered = [
			'categories' => $response['data'],
			'total' => $response['total']['posts'],
			'media_url' => PostLibrary::$MEDIA_URL
		];

		// Return Response For Ajax
		return $response_rendered;
	}

	// Get Data All User Post
	public function getUserPosts($page, $id)
	{
		// Get Response JSON From Post Library
		$response = PostLibrary::getUserPosts($page, $id);

		// Render Response As A Array
		$response_rendered = [
			'posts' => $response['data'],
			'total' => $response['total']['posts'],
			'media_url' => PostLibrary::$MEDIA_URL
		];

		// Return Response For Ajax
		return $response_rendered;
	}

	// Get Data All My Post
	public function getMyPosts($page)
	{
		$id = Session::get('id');

		// Get Response JSON From Post Library
		$response = PostLibrary::getUserPosts($id, $page);

		// Render Response As A Array
		$response_rendered = [
				'posts' => $response['data'],
				'total' => $response['total']['posts'],
				'media_url' => PostLibrary::$MEDIA_URL
		];

		// Return Response For Ajax
		return $response_rendered;
	}

	// Get data single posts
	public function getSinglePost($id)
	{
		// Get Response JSON From Post Library
		$response = PostLibrary::getSinglePost($id);

		// Check If Null
		if ($response['data']) {				
				// Set Variable
				$user = Session::get('id');
				$token = Session::get('token');
				
				// Render Response As A Array
				$response_rendered = [
						'post' => $response['data'][0],
						'media_url' => PostLibrary::$MEDIA_URL,
						'whoami' => $user
				];
				
				// Parameter to be passed to API
				$params = array(
					'post' => $id,
					'user' => $user,
				);
				
				// Get Response JSON From Post Library
				$response = ClickLibrary::createClick($params, $token);

				// Return View
				return view('post-detail', $response_rendered);
		}else{
				echo "Post is not available any more";;
		}
	}

	// Register new post
	public function createPost(Request $request)
	{
		// Set variable
		$title = $request->input('title');
		$text = $request->input('text');
		$category = $request->input('category');
		$refrence = $request->input('refrence');
		$creator = Session::get('id');
		$token = Session::get('token');
		$type = 0;

		// Check Plain Text or With Image
		if ($request->file('media')) {
			$fileName = $request->file('media');
			$fileType = $fileName->getClientOriginalExtension();

			// Naming media
			$media = base64_encode($title);

			// Parameter to be passed to API
			$params = array(
				'title' => $title,
				'text' => $text,
				'media' => $media.".".basename($fileType),
				'category' => $category,
				'creator' => $creator,
				'type' => $type,
				'refrence' => $refrence
			);

			// Get Response JSON From Post Library
			$response = PostLibrary::createPost($params, $token);

			// Upload media
			$uploadRequest = array(
				'fileData' => base64_encode(file_get_contents($fileName)),
				'fileType' => basename($fileType),
				'fileRename' => $media
			);

			// Get Response JSON From Post Library
			PostLibrary::uploadMedia($uploadRequest, $token);

			// Unlink fileName
			unlink($fileName);
		} else {
			// Default Media Post
			$media = "no-media.png";

			// Check If Link
			if ($request->input('media')) {
				$media = $request->input('media');
				$type = 1;	
			} 

			// Parameter to be passed to API
			$params = array(
				'title' => $title,
				'text' => $text,
				'media' => $media,
				'category' => $category,
				'creator' => $creator,
				'type' => $type,
				'refrence' => $refrence
			);

			// Get Response JSON From Post Library
			$response = PostLibrary::createPost($params, $token);
		}
		
		return redirect('timeline');
	}

	// Update post profile
	public function updatePost()
	{
		// Set variable
		$id = $request->input('id');
		$text = $request->input('text');
		$category = $request->input('category');
		$creator = Session::get('id');

		// Parameter to be passed to API
		$params = array(
			'id' => $id,
			'text' => $text,
			'category' => $category,
			'creator' => $creator
		);

		// Get Response JSON From Post Library
		$response = PostLibrary::updatePost($params);

		// Render Response As A Array
		$response_rendered = [
				'post' => $response['data'][0]
		];

		// Redirect to a page
		return view('post-detail', $response_rendered);
	}

	// Delete post
	public function deactivePost(Request $request)
	{
		// Set variable
		$post = $request->input('post');
		$token = Session::get('token');

		// Parameter to be passed to API
		$params = array(
				'id' => $post
		);

		// Get Response JSON From Post Library
		$response = PostLibrary::deactivePost($params, $token);

		// Check Error
		if ($response['error'] == 0) {
			// Redirect to a page
			return $response;
		} else {
			return redirect('');
		}

	}
}
