<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Survey
Route::get('/survey', function () {
	return Redirect::to('http://bit.ly/2slHGHM');
});

// Welcome
Route::get('/', 'WelcomeAPIController@checkLoginSession');

// Trending
Route::group(['prefix' => 'trending', 'middleware' => ['auth.session', 'cors']], function () {
	// Trending
	Route::get('/', function () {
		return view('trending');
	});

	// Get All Posts Order By Number Of Commented
	Route::get('commented/{page}', 'PostAPIController@getMostCommentedPosts');

	// Get All Posts Order By Number Of Upped
	Route::get('upped/{page}', 'PostAPIController@getMostUppedPosts');

	// Get All Category Order By Number Of Post
	Route::group(['prefix' => 'categories'], function () {
		// Categories
		Route::get('/', function () {
			return view('categories');
		});
		// Get Most Category
		Route::get('{page}', 'PostAPIController@getMostCategory');
		// Get All Categories
		Route::get('all', 'PostAPIController@getAllCategories');
	});
});

// Hot Posts
Route::group(['prefix' => 'hot', 'middleware' => ['auth.session', 'cors']], function () {
	// Timeline
	Route::get('/', function () {
		return view('timeline-hot');
	});
	// Get All Hot Posts API
	Route::get('{page}', 'PostAPIController@getAllHotPosts');
});

// Timeline, Post Detail, Comment
Route::group(['prefix' => 'timeline', 'middleware' => ['auth.session', 'cors']], function () {
	// Timeline
	Route::get('/', function () {
		return view('timeline');
	});
	// Get All Posts API
	Route::get('{page}', 'PostAPIController@getAllPosts');

	Route::group(['prefix' => 'post/{post_id}'], function () {
		// Post Detail API
		Route::get('/', 'PostAPIController@getSinglePost');
		// Deactive Post API
		Route::post('deactive', 'PostAPIController@deactivePost');
		// Get Comments From A Post API
		Route::get('comments', 'CommentAPIController@getPostComments');
		Route::group(['prefix' => 'comment'], function () {
			// Create Comment API
			Route::post('create', 'CommentAPIController@createComment');

			// Deactive Comment API
			Route::post('deactive', 'CommentAPIController@deactiveComment');
		});

		// Get Ups From A Post API
		Route::get('ups', 'UpAPIController@getPostUps');

		Route::group(['prefix' => 'up'], function () {
			// Create Up API
			Route::post('create', 'UpAPIController@createUp');
			// Deactive Up API
			Route::get('delete/{up}', 'UpAPIController@deleteUp');
		});
	});
});

// Most Category Posts
Route::group(['prefix' => 'trending', 'middleware' => ['auth.session', 'cors']], function () {
	// Get All Trending Category Posts API View
	Route::get('/category/{category}/posts', 'PostAPIController@getCategoryPostsView');

	// Get All Trending Category Posts API
	Route::get('/category/{category}/posts/{page}', 'PostAPIController@getCategoryPosts');
});

// Connection
Route::group(['prefix' => 'connection', 'middleware' => ['auth.session', 'cors']], function () {
	// Get All Users API
	Route::get('{page}', 'UserAPIController@getAllUsers');

	// Connection
	Route::get('/', function () {
		return view('connection');
	});

	// Profile
	Route::group(['prefix' => 'profile/{user_id}'], function () {
		// Info User
		Route::get('/', 'UserAPIController@getSingleUser');

		// User's Posts
		Route::get('posts/{page}', 'PostAPIController@getUserPosts');
	});
});

// Notification
Route::group(['prefix' => 'notification', 'middleware' => ['auth.session', 'cors']], function () {
	// Get All Notifications API
	Route::get('get', 'NotificationsAPIController@getNotifications');

	// Deactive Notification API
	Route::get('deactive', 'NotificationsAPIController@deactiveNotifications');

	// Notification
	Route::get('/', function () {
		return view('notification');
	});
});

// My Profile
Route::group(['prefix' => 'profile', 'middleware' => ['auth.session', 'cors']], function () {
	// Info User
	Route::get('/', 'UserAPIController@getMyProfile');

	// My Posts
	Route::get('posts/{page}', 'PostAPIController@getMyPosts');

	// Edit Profile View
	Route::get('edit', 'UserAPIController@updateUserProfileView');

	// Edit Profile
	Route::post('edit', 'UserAPIController@updateUserProfile');

	// Edit Password View
	Route::get('password', function () {
		return view('edit-password');
	});

	// Edit Password
	Route::post('password', 'UserAPIController@updateUserPassword');

	// Deactive Account
	Route::get('deactive', 'UserAPIController@deactiveUser');
});

// User Auth
Route::group(['prefix' => 'auth'], function () {
	// Sign In API
	Route::post('signin', 'UserAPIController@signin');

	// Sign Out API
	Route::get('signout', 'UserAPIController@signout')->middleware(['auth.session', 'cors']);

	// Sign Up
	Route::post('signup', 'UserAPIController@signup');
});

// Create Post
Route::group(['prefix' => 'post', 'middleware' => ['auth.session', 'cors']], function () {
	// Create Post View
	Route::get('create', function () {
		return view('create-post');
	});

	// Create Post API
	Route::post('create', 'PostAPIController@createPost');
});

// Search
Route::group(['prefix' => 'search', 'middleware' => ['auth.session', 'cors']], function () {
	// Search User
	Route::get('user/{page}/{search_keyword}', 'UserAPIController@searchUser');
});
