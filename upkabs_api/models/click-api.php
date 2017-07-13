<?php
/**
This controller has a copyright tandrysyawaludin at 2017 for commercial.
name: tandrys syawaludin soedijanto
email: syawaludintandry@yahoo.com
*/

class ClickAPI
{
	// Register new post
	public function createClick()
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

	    // Die If Sql Statement Failed
	    if (!$result_check_token) {
	      echo'{"data":0,"error":1,"message":"404 not found"}';
	      http_response_code(404);
	      die(mysqli_error());
	    } else {
			if (mysqli_num_rows($result_check_token) > 0) {
				// SQL Query
				$sql_insert_click = "INSERT ignore into click set $set";

				// Excecute SQL Statement
				$result_insert_click = mysqli_query($link, $sql_insert_click);

				// Die If Sql Statement Failed
				if (!$result_insert_click) {
			      echo'{"data":0,"error":1,"message":"404 not found"}';
			      http_response_code(404);
			      die(mysqli_error());
			    } else {
			      echo'{"data":0,"error":0,"message":"success"}';
			    }
			} else {
				echo'{"data":0,"error":1,"message":"token is deactive"}';
			}
		}

		// close mysql Connection
		mysqli_close($link);
	}

}

// Get the HTTP method, path and body of the request
$method  =  $_SERVER['REQUEST_METHOD'];
$request  =  explode('/', trim($_SERVER['REQUEST_URI'],'/'));

// Declaration class
$ClickAPI  =  new ClickAPI;

// Call function based on HTTP method
switch ($method) {
	case 'GET':
	break;
	case 'PUT':
	break;
	case 'POST':
		$ClickAPI->createClick();
	break;
}
