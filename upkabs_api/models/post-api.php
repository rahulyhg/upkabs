<?php
/**
This controller has a copyright tandrysyawaludin at 2017 for commercial.
name: tandrys syawaludin soedijanto
email: syawaludintandry@yahoo.com
*/

class PostAPI
{
	// Get All Data Posts
	public function getAllPosts($page)
	{
		// Set Variabel
		$start_limit = 0;

		// If page more than 0
		if ($page > 0) {
			$start_limit = $page * 10;
		}

		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Count data
		$sql_data_count  =  "SELECT count(post.id) as posts from user left join post on post.creator = user.id where post.deactive = 0";

		// Excecute SQL Statement
		$data_count =  mysqli_query($link, $sql_data_count);

		// SQL Query All Post Order By Date
		$sql_posts  =  "SELECT post.id, post.title, post.date, post.media, post.type, post.category, user.name from user left join post on post.creator = user.id where post.deactive = 0 order by post.date desc limit $start_limit, 10";

		// Excecute SQL Statement All Post Order By Date
		$result  =  mysqli_query($link, $sql_posts);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result) {
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Print results
			echo'{"data":[';
			for ($i = 0; $i < mysqli_num_rows($result); $i++) {
				echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result));
			};
			echo '],"total":'.json_encode(mysqli_fetch_object($data_count));
			echo '}';
		}

		// close mysql Connection
		mysqli_close($link);
	}

	// Get All Hot Data Posts
	public function getAllHotPosts($page)
	{
		// Set Variabel
		$start_limit = 0;

		// If page more than 0
		if ($page > 0) {
			$start_limit = $page * 10;
		}

		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Count data
		$sql_data_count  =  "SELECT count(post.id) as posts from user inner join up on up.upper = user.id left join comment on comment.commentator = user.id inner join post on post.id = up.post where post.deactive = 0 group by post.id order by post.date desc";

		// Excecute SQL Statement
		$data_count =  mysqli_query($link, $sql_data_count);

		// SQL Query Two Post Order By Most Bookmarked
		$sql_posts  =  "SELECT count(up.id) as upped, count(comment.id) as commented, post.id, post.title, post.date, post.media, post.type, post.category, user.name from user inner join post on user.id = post.creator left join comment on comment.commentator = user.id left join up on up.upper = user.id where post.deactive = 0 group by post.id order by post.date desc limit $start_limit, 10";

		// Excecute SQL Statement All Post Order By Date
		$result  =  mysqli_query($link, $sql_posts);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result) {
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Print results
			echo'{"data":[';
			for ($i = 0; $i < mysqli_num_rows($result); $i++) {
				echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result));
			};
			echo '],"total":'.json_encode(mysqli_fetch_object($data_count));
			echo '}';
		}

		// close mysql Connection
		mysqli_close($link);
	}

	// Get All Data Most Category Posts
	public function getCategoryPosts($category, $page)
	{
		// Set Variabel
		$start_limit = 0;

		// If page more than 0
		if ($page > 0) {
			$start_limit = $page * 10;
		}

		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Count data
		$sql_data_count  =  "SELECT count(post.id) as posts from user left join post on post.creator = user.id where post.category = '$category' and post.deactive = 0";

		// Excecute SQL Statement
		$data_count =  mysqli_query($link, $sql_data_count);

		// SQL Query All Post Order By Date
		$sql_posts  =  "SELECT post.id, post.title, post.date, post.media, post.type, post.category, user.name from user inner join post on post.creator = user.id where post.category = '$category' and post.deactive = 0 order by post.date desc limit $start_limit, 10";

		// Excecute SQL Statement All Post Order By Date
		$result  =  mysqli_query($link, $sql_posts);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result) {
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Print results
			echo'{"data":[';
			for ($i = 0; $i < mysqli_num_rows($result); $i++) {
				echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result));
			};
			echo '],"total":'.json_encode(mysqli_fetch_object($data_count));
			echo '}';
		}

		// close mysql Connection
		mysqli_close($link);
	}

	// Get Data All Posts Order By Number Of Bookmark
	public function getMostBookmarkedPosts()
	{
		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Count data
		$sql_data_count  =  "SELECT count(post.id) as posts from user left join up on up.upper = user.id inner join post on post.id = up.post where post.deactive = 0 group by post.id order by count(up.id) desc";

		// Excecute SQL Statement
		$data_count =  mysqli_query($link, $sql_data_count);

		// SQL Query Two Post Order By Most Bookmarked
		$sql_posts  =  "SELECT post.id, post.title, post.date, post.media, post.type, post.category, user.name from user inner join up on up.upper = user.id inner join post on post.id = up.post where post.deactive = 0 group by post.id order by count(up.id) desc limit 10";

		// Excecute SQL Statement All Post Order By Date
		$result  =  mysqli_query($link, $sql_posts);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result) {
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Print results
			echo'{"data":[';
			for ($i = 0; $i < mysqli_num_rows($result); $i++) {
				echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result));
			};
			echo '],"total":'.json_encode(mysqli_fetch_object($data_count));
			echo '}';
		}

		// close mysql Connection
		mysqli_close($link);
	}

	// Get Data All Post Order By Number Of Comment
	public function getMostCommentedPosts()
	{
		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Count data
		$sql_data_count  =  "SELECT count(post.id) as posts from user left join comment on comment.commentator = user.id inner join post on post.id = comment.post where post.deactive = 0 group by post.id";

		// Excecute SQL Statement
		$data_count =  mysqli_query($link, $sql_data_count);

		// SQL Query One Post Order By Most Commented
		$sql_posts =  "SELECT post.id, post.title, post.date, post.media, post.type, post.category, user.name from user left join comment on comment.commentator = user.id inner join post on post.id = comment.post where post.deactive = 0 group by post.id order by count(comment.id) desc limit 10";

		// Excecute SQL Statement All Post Order By Date
		$result  =  mysqli_query($link, $sql_posts);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result) {
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Print results
			echo'{"data":[';
			for ($i = 0; $i < mysqli_num_rows($result); $i++) {
				echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result));
			};
			echo '],"total":'.json_encode(mysqli_fetch_object($data_count));
			echo '}';
		}

		// close mysql Connection
		mysqli_close($link);
	}

	// Get Data All Post Order By Number Of Comment
	public function getMostCategory($page)
	{
		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Count data
		$sql_data_count  =  "SELECT count(post.id) as posts from user left join post on post.creator = user.id where post.deactive = 0 group by post.category";

		// Excecute SQL Statement
		$data_count =  mysqli_query($link, $sql_data_count);

		// SQL Query One Post Order By Most Commented
		$sql_posts =  "SELECT post.category from user left join post on post.creator = user.id where post.deactive = 0 group by post.category order by count(post.category) desc limit 10";

		// Excecute SQL Statement All Post Order By Date
		$result  =  mysqli_query($link, $sql_posts);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result) {
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Print results
			echo'{"data":[';
			for ($i = 0; $i < mysqli_num_rows($result); $i++) {
				echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result));
			};
			echo '],"total":'.json_encode(mysqli_fetch_object($data_count));
			echo '}';
		}

		// close mysql Connection
		mysqli_close($link);
	}

	// Get Data All Categories
	public function getAllCategories()
	{
		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Count data
		$sql_data_count  =  "SELECT count(post.id) as posts from user left join post on post.creator = user.id where post.deactive = 0 group by post.category";

		// Excecute SQL Statement
		$data_count =  mysqli_query($link, $sql_data_count);

		// SQL Query One Post Order By Most Commented
		$sql_posts =  "SELECT post.category from user left join post on post.creator = user.id where post.deactive = 0 group by post.category order by count(post.category) desc";

		// Excecute SQL Statement All Post Order By Date
		$result  =  mysqli_query($link, $sql_posts);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result) {
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Print results
			echo'{"data":[';
			for ($i = 0; $i < mysqli_num_rows($result); $i++) {
				echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result));
			};
			echo '],"total":'.json_encode(mysqli_fetch_object($data_count));
			echo '}';
		}

		// close mysql Connection
		mysqli_close($link);
	}

	// Get data single posts
	public function getSinglePost($id)
	{
		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// SQL Query
		$sql  =  "SELECT post.id, post.title, post.text, post.date, post.media, post.type, post.refrence, post.category, post.creator, user.name from user left join post on post.creator = user.id where post.id = '$id' and post.deactive = 0";

		// Excecute SQL Statement
		$result  =  mysqli_query($link, $sql);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result) {
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Print results
			echo'{"data":[';
			for ($i = 0; $i < mysqli_num_rows($result); $i++) {
				echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result));
			}
			echo ']';
			echo '}';
		}

		// close mysql Connection
		mysqli_close($link);
	}

	// Create New Post
	public function createPost()
	{
		// Get all input value
		$input  =  file_get_contents('php://input');

		// Parsing input to array
		parse_str($input, $data);

		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Escape the columns and values from the input object
		$columns  =  preg_replace('/[^a-z0-9_]+/i', '', array_keys($data));
		$values  =  array_map(function ($value) use ($link) {
			if ($value === null) return null;
			return mysqli_real_Escape_string($link,(string)$value);
		},array_values($data));

		// Build the SET part of the SQL command
		$set  =  '';
		for ($i = 0;$i<count($columns);$i++) {
			$set.=($i > 0?',':'').'`'.$columns[$i].'` = ';
			$set.=($values[$i] === null?'NULL':'"'.$values[$i].'"');
		}

		// Get token From Authorization
		$headers = apache_request_headers();
		$token = $headers['Authorization'];

		// SQL Query
		$sql_check_token = "SELECT * from uwt where token = '$token' and deactive = 0";

		// Excecute SQL Statement
		$result_check_token = mysqli_query($link, $sql_check_token);

		// Header For Json
		header('Content-Type: application/json');

		// Create Post Is Fail If Token Is Deactive
		if (!$result_check_token) {
			echo '{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			if (mysqli_num_rows($result_check_token) > 0) {
				// SQL Query
				$sql = "INSERT into post set $set";

				// Excecute SQL Statement
				$result = mysqli_query($link, $sql);

				// Response Message
				echo '{"data":0,"error":0,"message":"success"}';
			} else {
				// Response Message
				echo '{"data":0,"error":1,"message":"token is deactive"}';
			}

		}

		// close mysql Connection
		mysqli_close($link);
	}

	// Upload Image
	public function uploadMedia()
	{
		// Declaration variable of media
		$fileRename = $_POST['fileRename'];
		$fileType = '.'.$_POST['fileType'];

		// Declare path in server
		$uploadDir = '../storage/media/';

		// Get token From Authorization
		$headers = apache_request_headers();
		$token = $headers['Authorization'];

		// SQL Query
		$sql_check_token = "SELECT * from uwt where token = '$token' and deactive = 0";

		// Excecute SQL Statement
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0', 'upkabsco_db');
		$result_check_token = mysqli_query($link, $sql_check_token);

		// Header For Json
		header('Content-Type: application/json');

		// Create Post Is Fail If Token Is Deactive Or Not
		if (!$result_check_token) {
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			if (mysqli_num_rows($result_check_token) > 0) {
				// Put file in server
				file_put_contents(
					$uploadDir.$fileRename.$fileType,
					base64_decode($_POST['fileData'])
				);
			} else {
				echo'{"data":0,"error":1,"message":"token is deactive"}';
			}
		}
	}

	// Delete post
	public function deactivePost()
	{
		// Set variable
		$input  =  file_get_contents('php://input');

		// Parsing input to array
		parse_str($input, $data);

		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Escape the columns and values from the input object
		$columns  =  preg_replace('/[^a-z0-9_]+/i', '', array_keys($data));
		$values  =  array_map(function ($value) use ($link) {
			if ($value === null) return null;
			return mysqli_real_Escape_string($link,(string)$value);
		},array_values($data));

		// Build the SET part of the SQL command
		$set  =  '';
		for ($i = 0;$i<count($columns);$i++) {
			$set.=($i > 0?',':'').'`'.$columns[$i].'` = ';
			$set.=($values[$i] === null?'NULL':'"'.$values[$i].'"');
		}

		// Get token From Authorization
		$headers = apache_request_headers();
		$token = $headers['Authorization'];

		// SQL Query
		$sql_check_token = "SELECT * from uwt where token = '$token' and deactive = 0";

		// Excecute SQL Statement
		$result_check_token = mysqli_query($link, $sql_check_token);

		// Header For Json
		header('Content-Type: application/json');

		// Create Post Is Fail If Token Is Deactive
		if (!$result_check_token) {
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			if (mysqli_num_rows($result_check_token) > 0) {
				// SQL Query
				$sql  =  "update post set deactive = 1 where $set";

				// Excecute SQL Statement
				$result  =  mysqli_query($link, $sql);
			} else {
				echo'{"data":0,"error":1,"message":"token is deactive"}';
			}
		}

		// close mysql Connection
		mysqli_close($link);
	}

	// Search posts
	public function getUserPosts($user, $page)
	{
		// Set variable
		$start_limit = 0;
		$end_limit = 10;

		// If page more than 0
		if ($page > 0) {
			$start_limit = $page * 10;
			$end_limit = 10;
		}

		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Count data
		$sql_data_count =  "SELECT count(post.id) as posts from user left join post on post.creator = user.id where post.creator = $user and post.deactive = 0";

		// Excecute SQL Statement
		$data_count =  mysqli_query($link, $sql_data_count);

		// SQL Query
		$sql_user_posts = "SELECT post.id, post.title, post.date, post.media, post.type, post.category, user.name from user left join post on post.creator = user.id where post.creator = $user and post.deactive = 0 order by post.date desc limit $start_limit, $end_limit";

		// Excecute SQL Statement
		$result_user_posts  =  mysqli_query($link, $sql_user_posts);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result_user_posts) {
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Print results
			echo'{"data":[';
			for ($i = 0; $i < mysqli_num_rows($result_user_posts); $i++) {
				echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result_user_posts));
			}
			echo '],"total":'.json_encode(mysqli_fetch_object($data_count));
			echo'}';
		}

		// close mysql Connection
		mysqli_close($link);
	}

	// Update post profile
	public function updatePost($post)
	{
		// Set variable
		$input  =  file_get_contents('php://input');

		// Parsing input to array
		parse_str($input, $data);

		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Escape the columns and values from the input object
		$columns  =  preg_replace('/[^a-z0-9_]+/i', '', array_keys($data));
		$values  =  array_map(function ($value) use ($link) {
			if ($value === null) return null;
			return mysqli_real_Escape_string($link,(string)$value);
		},array_values($data));

		// Build the SET part of the SQL command
		$set  =  '';
		for ($i = 0;$i<count($columns);$i++) {
			$set.=($i > 0?',':'').'`'.$columns[$i].'` = ';
			$set.=($values[$i] === null?'NULL':'"'.$values[$i].'"');
		}

		// SQL Query
		$sql  =  "UPDATE post set $set where id = $post";

		// Excecute SQL Statement
		$result  =  mysqli_query($link,$sql);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result) {
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			echo'{"data":0,"error":0,"message":"success"}';
		}

		// close mysql Connection
		mysqli_close($link);
	}

}

// Get the HTTP method, path and body of the request
$method  =  $_SERVER['REQUEST_METHOD'];
$request  =  explode('/', trim($_SERVER['REQUEST_URI'],'/'));

// Declaration class
$PostAPI  =  new PostAPI;

// Call function based on HTTP method
switch ($method) {
	case 'GET':
		if (strcmp($request[2], 'user') == 0) {
			$PostAPI->getUserPosts($request[3], $request[4]);
		} elseif (strcmp($request[2], 'single') == 0) {
			$PostAPI->getSinglePost($request[3]);
		} elseif (strcmp($request[2], 'commented') == 0) {
			$PostAPI->getMostCommentedPosts($request[3]);
		} elseif (strcmp($request[2], 'upped') == 0) {
			$PostAPI->getMostBookmarkedPosts($request[3]);
		} elseif (strcmp($request[2], 'category') == 0) {
			if (strcmp($request[4], 'posts') == 0) {
				$PostAPI->getCategoryPosts($request[3], $request[5]);
			} else {
				if (strcmp($request[3], 'all') == 0) {
					$PostAPI->getAllCategories();
				} else {
					$PostAPI->getMostCategory($request[3]);
				}
			}
		} elseif (strcmp($request[2], 'hot') == 0) {
			$PostAPI->getAllHotPosts($request[3]);
		} else {
			$PostAPI->getAllPosts($request[2]);
		}
	break;
	case 'PUT':
		$PostAPI->deactivePost();
	break;
	case 'POST':
		if (isset($request[3])) {
			$PostAPI->uploadMedia();
		}else{
			$PostAPI->createPost();
		}
	break;
}
