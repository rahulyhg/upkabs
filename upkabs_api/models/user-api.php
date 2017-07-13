<?php
/**
This controller has a copyright tandrysyawaludin at 2017 for commercial.
name: tandrys syawaludin soedijanto
email: syawaludintandry@yahoo.com
*/

class UserAPI
{
	// Get all data users
	public function getAllUsers($page)
	{
		// Set table as a sent parameter
		$start_limit = 0;
		$end_limit = 10;

		// If Page More Than 0
		if ($page > 0) {
			$start_limit = $page * 10;
			$end_limit = 10;
		}

		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0', 'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Count data
		$sql_data_count  =  "SELECT count(id) as users from user where deactive = 0";

		// Excecute SQL Statement
		$data_count =  mysqli_query($link, $sql_data_count);

		// SQL query
		$sql_get_users  =  "SELECT * from user where deactive = 0 limit $start_limit, $end_limit";

		// Excecute SQL Statement
		$result_get_users  =  mysqli_query($link, $sql_get_users);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result_get_users) {
			// Response JSON
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Response JSON
			echo'{"data":[';
			for ($i = 0; $i < mysqli_num_rows($result_get_users); $i++) {
				echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result_get_users));
			}
			echo '],"total":'.json_encode(mysqli_fetch_object($data_count));
			echo ',"error":0,"message":"success"}';
		}

		// Close Mysql Connection
		mysqli_close($link);
	}

	// Get data single users
	public function getSingleUser($id)
	{
		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0', 'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// SQL query
		$sql  =  "SELECT * from user WHERE id = '$id'";

		// Excecute SQL Statement
		$result  =  mysqli_query($link, $sql);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result) {
			// Response JSON
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Response JSON
			echo'{"data":[';
			for ($i = 0; $i < mysqli_num_rows($result); $i++) {
				echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result));
			}
			echo '],"error":0,"message":"success"}';
		}

		// Close Mysql Connection
		mysqli_close($link);
	}

	// Update User Profile
	public function updateUserProfile($id)
	{
		// Set variable
		$input  =  file_get_contents('php://input');

		// Parsing input to array
		parse_str($input, $data);

		// connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0', 'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// escape the columns and values from the input object
		$columns  =  preg_replace('/[^a-z0-9_]+/i', '', array_keys($data));
		$values  =  array_map(function ($value) use ($link) {
			if ($value === null) return null;
			return mysqli_real_escape_string($link,(string)$value);
		},array_values($data));

		// build the SET part of the SQL command
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

		// Die If SQL Statement Failed
		if (!$result_check_token) {
			// Response JSON
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			if (mysqli_num_rows($result_check_token) > 0) {
				// Response JSON
				echo '{"data":0,"error":0,"message":"success"}';

				// SQL query
				$sql_update_profile  =  "UPDATE user set $set where id = $id";

				// Excecute SQL Statement
				$result_update_profile  =  mysqli_query($link,$sql_update_profile);

				// Die If SQL Statement Failed
				if (!$result_check_token) {
					echo'{"data":0,"error":1,"message":"404 not found"}';
					http_response_code(404);
					die(mysqli_error());
				} else {
					// Response JSON
					echo '{"data":0,"error":0,"message":"success"}';
				}
			} else {
				// Response JSON
				echo '{"data":0,"error":1,"message":"token is deactive"}';
			}
		}

		// Close Mysql Connection
		mysqli_close($link);
	}

	// Update User Password
	public function updateUserPassword($id)
	{
		// Set variable
		$input  =  file_get_contents('php://input');

		// Parsing input to array
		parse_str($input, $data);

		// connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0', 'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// escape the columns and values from the input object
		$columns  =  preg_replace('/[^a-z0-9_]+/i', '', array_keys($data));
		$values  =  array_map(function ($value) use ($link) {
			if ($value === null) return null;
			return mysqli_real_escape_string($link,(string)$value);
		},array_values($data));

		// Declare Password
		$current_password = $values[0];
		$new_password = $values[1];

		// Get token From Authorization
		$headers = apache_request_headers();
		$token = $headers['Authorization'];

		// SQL Query
		$sql_check_token = "SELECT * from uwt where token = '$token' and deactive = 0";

		// Excecute SQL Statement
		$result_check_token = mysqli_query($link, $sql_check_token);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result_check_token) {
			// Response JSON
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Create Post Is Fail If Token Is Deactive
			if (mysqli_num_rows($result_check_token) > 0) {
				// SQL Query
				$sql_check_current_password = "SELECT id from user where password = md5('$current_password')";

				// Excecute SQL Statement
				$result_check_current_password = mysqli_query($link, $sql_check_current_password);

				// Change Password I sFaild If Current Password Is Wrong
				if (mysqli_num_rows($result_check_current_password) == 0) {
					// Response JSON
					$error = '{"data":0,"error":1,"message":"current password is not valid"}';
				} else {
					// Response JSON
					$error = '{"data":0,"error":0,"message":"success"}';

					// SQL query
					$sql  =  "UPDATE user set password = md5('$new_password') where id = $id";

					// Excecute SQL Statement
					$result  =  mysqli_query($link,$sql);
				}
			} else {
				// Response JSON
				echo '{"data":0,"error":1,"message":"token is deactive"}';
			}
		}

		// Close Mysql Connection
		mysqli_close($link);
	}

	// Upload Image
	public function uploadAvatar()
	{
		// Declaration variable of media
		$fileRename = $_POST['fileRename'];
		$fileType = '.'.$_POST['fileType'];

		// Declare path in server
		$uploadDir = '../storage/avatar/';

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

		// Die If SQL Statement Failed
		if (!$result_check_token) {
			// Response JSON
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			if (mysqli_num_rows($result_check_token) > 0) {
				// Response JSON
				echo '{"data":0,"error":0,"message":"success"}';

				// Put file in server
				file_put_contents(
					$uploadDir.$fileRename.$fileType,
					base64_decode($_POST['fileData'])
				);
			} else {
				// Response JSON
				echo '{"data":0,"error":1,"message":"token is deactive"}';
			}
		}

		// Close Mysql Connection
		mysqli_close($link);
	}

	// Delete user
	public function deactiveUser()
	{
		// Set variable
		$input  =  file_get_contents('php://input');
		$input = preg_replace_callback('/(?:^|(?<=&))[^=[]+/', function($match) {
		        return bin2hex(urldecode($match[0]));
		    }, $input);

		// Parsing input to array
		parse_str($input, $data);

		$data = array_combine(array_map('hex2bin', array_keys($data)), $data);

		// Connect to the mysql database
		$link  =  mysqli_Connect('localhost', 'upkabsco_admin', 'Soedijant0', 'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Escape the columns and values from the input object
		$columns  =  preg_replace('/[^a-z0-9_.]+/i', '', array_keys($data));
		$values  =  array_map(function ($value) use ($link) {
			if ($value === null) return null;
			return mysqli_real_Escape_string($link,(string)$value);
		},array_values($data));

		// Build the SET part of the SQL command
		$set  =  '';
		for ($i = 0;$i<count($columns);$i++) {
			$set.=($i > 0?' and ':'').''.$columns[$i].' = ';
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

		// Die If SQL Statement Failed
		if (!$result_check_token) {
			// Response JSON
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			if (mysqli_num_rows($result_check_token) > 0) {
				// SQL query
				$sql_deactive_user = "UPDATE user set deactive = 1 where id = ".$data['user'];

				// Excecute SQL Statement
				$result_deactive_user = mysqli_query($link, $sql_deactive_user );

				// Die If SQL Statement Failed
				if (!$result_deactive_user) {
					// Response JSON
					echo'{"data":0,"error":1,"message":"404 not found"}';
					http_response_code(404);
					die(mysqli_error());
				} else {
					// SQL query
					$sql_deactive_user = "UPDATE post set deactive = 1 where id = ".$data['user'];
					
					// Excecute SQL Statement
					$result_deactive_user = mysqli_query($link, $sql_deactive_user );

					// SQL query
					$sql_deactive_user = "UPDATE comment set deactive = 1 where id = ".$data['user'];
					
					// Excecute SQL Statement
					$result_deactive_user = mysqli_query($link, $sql_deactive_user );

					// Response JSON
					echo '{"data":0,"error":0,"message":"success"}';
				}
			} else {
				// Response JSON
				echo '{"data":0,"error":1,"message":"token is deactive"}';
			}
		}

		// close mysql Connection
		mysqli_close($link);
	}

	// Search users
	public function searchUser($page, $search_keyword)
	{
		// Set table as a sent parameter
		$start_limit = 0;
		$end_limit = 10;

		// If Page More Than 0
		if ($page > 0) {
			$start_limit = $page * 10;
			$end_limit = 10;
		}

		// Connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0', 'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// Count data
		$sql_data_count  =  "SELECT count(id) as users from user where name like '%$search_keyword%' and deactive = 0";

		// Excecute SQL Statement
		$data_count =  mysqli_query($link, $sql_data_count);

		// SQL query
		$sql_search_user  =  "SELECT * from user where name like '%$search_keyword%' and deactive = 0 limit $start_limit, $end_limit";

		// Excecute SQL Statement
		$result_search_user  =  mysqli_query($link, $sql_search_user);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result_search_user) {
			// Response JSON
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Response JSON
			echo'{"data":[';
			for ($i = 0; $i < mysqli_num_rows($result_search_user); $i++) {
				echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result_search_user));
			}
			echo '],"total":'.json_encode(mysqli_fetch_object($data_count));
			echo ',"error":"1","message":"success"}';
		}

		// Close Mysql Connection
		mysqli_close($link);
	}

	// Signin
	public function signin()
	{
		// Get all input value
		$input  =  file_get_contents('php://input');

		// Parsing input to array
		parse_str($input, $data);

		// Set variable
		$email = $data['email'];
		$password = $data['password'];

		// connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0', 'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// escape the columns and values from the input object
		$columns  =  preg_replace('/[^a-z0-9_]+/i', '', array_keys($data));
		$values  =  array_map(function ($value) use ($link) {
			if ($value === null) return null;
			return mysqli_real_escape_string($link,(string)$value);
		},array_values($data));

		// SQL query
		$sql_check_user  =  "SELECT * from user where email = '$email' and password = md5('$password') and deactive = 0";

		// Excecute SQL Statement
		$result_check_user =  mysqli_query($link, $sql_check_user);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result_check_user) {
			// Response JSON
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Token Generator
			$token = 'UWT '.md5(uniqid(rand(), true));
			$ip = $data['ip'];
			$user_agent = $data['user_agent'];

			// Response JSON
			echo'{"data":[';
			for ($i = 0; $i < mysqli_num_rows($result_check_user); $i++) {
				echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result_check_user));
			}

			// Insert token
			foreach ($result_check_user as $key => $value) {
				$user = $value['id'];

				// SQL query
				$sql_insert_uwt = "INSERT into uwt (`token`, `user`, `ip`, `user_agent`) VALUES ('$token', '$user', '$ip', '$user_agent')";

				// Excecute SQL Statement
				$result_insert_uwt = mysqli_query($link, $sql_insert_uwt);

				// Die If SQL Statement Failed
				if (!$result_insert_uwt) {
					echo'{"data":0,"error":1,"message":"404 not found"}';
					http_response_code(404);
					die(mysqli_error());
				}
			}

			echo '],"token":"'.$token;
			echo '","error":"0","message":"success"}';
		}

		// Close Mysql Connection
		mysqli_close($link);
	}

	// Signout
	public function signout()
	{
		// Get all input value
		$input  =  file_get_contents('php://input');

		// Parsing input to array
		parse_str($input, $data);

		// Set variable
		$id = $data['id'];

		// connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0', 'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// SQL query
		$sql  =  "UPDATE uwt set deactive = 1 where user = '$id'";

		// Excecute SQL Statement
		$result  =  mysqli_query($link, $sql);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result) {
			// Response JSON
			echo'{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Response JSON
			echo '{"data":0,"error":0,"message":"success"}';
		}

		// Close Mysql Connection
		mysqli_close($link);
	}

	// Signup
	public function signup()
	{
		// Get all input value
		$input  =  file_get_contents('php://input');

		// Parsing input to array
		parse_str($input, $data);

		// connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0', 'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// escape the columns and values from the input object
		$columns  =  preg_replace('/[^a-z0-9_]+/i', '', array_keys($data));
		$values  =  array_map(function ($value) use ($link) {
			if ($value === null) return null;
			return mysqli_real_escape_string($link,(string)$value);
		},array_values($data));

		// build the SET part of the SQL command
		$set  =  '';
		for ($i = 0;$i<count($columns);$i++) {
			$set.=($i > 0?',':'').'`'.$columns[$i].'` = ';
			$set.=($values[$i] === null?'NULL':'"'.$values[$i].'"');
		}

		// SQL query
		$sql  =  "INSERT into user set $set";

		// Excecute SQL Statement
		$result  =  mysqli_query($link,$sql);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result) {
			// Response JSON
			echo '{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Response JSON
			echo '{"data":0,"error":0,"message":"success"}';
		}

		// Close Mysql Connection
		mysqli_close($link);
	}

	// Forgor Password
	public function forgotPassword()
	{
		// Get all input value
		$input  =  file_get_contents('php://input');

		// Parsing input to array
		parse_str($input, $data);

		// connect to the mysql database
		$link  =  mysqli_connect('localhost', 'upkabsco_admin', 'Soedijant0', 'upkabsco_db');
		mysqli_set_charset($link,'utf8');

		// escape the columns and values from the input object
		$columns  =  preg_replace('/[^a-z0-9_]+/i', '', array_keys($data));
		$values  =  array_map(function ($value) use ($link) {
			if ($value === null) return null;
			return mysqli_real_escape_string($link,(string)$value);
		},array_values($data));

		// build the SET part of the SQL command
		$set  =  '';
		for ($i = 0;$i<count($columns);$i++) {
			$set.=($i > 0?',':'').'`'.$columns[$i].'` = ';
			$set.=($values[$i] === null?'NULL':'"'.$values[$i].'"');
		}
		
		var_dump($values);

		// SQL query
		$sql  =  "INSERT into user set $set";

		// Excecute SQL Statement
		$result  =  mysqli_query($link,$sql);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result) {
			// Response JSON
			echo '{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Response JSON
			echo '{"data":0,"error":0,"message":"success"}';
		}

		// Close Mysql Connection
		mysqli_close($link);
	}

	// Signout
	public function checkLoginSession($id)
	{
		// Get token From Authorization
		$headers = apache_request_headers();
		$token = $headers['Authorization'];

		// SQL Query
		$sql_check_token = "SELECT * from uwt where token = '$token' and deactive = 0 and user = '$id'";

		// Excecute SQL Statement
		$result_check_token = mysqli_query($link, $sql_check_token);

		// Header For Json
		header('Content-Type: application/json');

		// Die If SQL Statement Failed
		if (!$result_check_token) {
			// Response JSON
			echo '{"data":0,"error":1,"message":"404 not found"}';
			http_response_code(404);
			die(mysqli_error());
		} else {
			// Response JSON
			echo '{"data":0,"error":0,"message":"token is active"}';
		}

		// Close Mysql Connection
		mysqli_close($link);
	}
}

// Get the HTTP method, path and body of the request
$method  =  $_SERVER['REQUEST_METHOD'];
$request  =  explode('/', trim($_SERVER['REQUEST_URI'],'/'));

// Declaration class
$UserAPI  =  new UserAPI;

// Call function based on HTTP method
switch ($method) {
	case 'GET':
		if (isset($request[3])) {
			if (strcmp($request[3], 'search') == 0) {
				$UserAPI->searchUser($request[2], $request[4]);
			} elseif (strcmp($request[3], 'check') == 0) {
				$UserAPI->checkLoginSession($request[2]);
			} else {
				$UserAPI->getSingleUser($request[3]);
			}
		}else{
			$UserAPI->getAllUsers($request[2]);
		}
	break;
	case 'PUT':
		if (strcmp($request[2], 'deactive') == 0) {
			$UserAPI->deactiveUser();
		} elseif (strcmp($request[2], 'profile') == 0) {
			$UserAPI->updateUserProfile($request[3]);
		} else {
			$UserAPI->updateUserPassword($request[3]);
		}
	break;
	case 'POST':
		if (strcmp($request[3], 'signup') == 0) {
			$UserAPI->signup();
		} elseif (strcmp($request[3], 'signin') == 0) {
			$UserAPI->signin();
		} elseif (strcmp($request[3], 'signout') == 0) {
			$UserAPI->signout();
		} elseif (strcmp($request[3], 'uploadavatar') == 0) {
			$UserAPI->uploadAvatar();
		} elseif (strcmp($request[3], 'forgot_password') == 0) {
			$UserAPI->forgotPassword();
		}
	break;
}
