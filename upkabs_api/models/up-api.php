<?php
/**
This controller has a copyright tandrysyawaludin at 2017 for commercial.
name: tandrys syawaludin soedijanto
email: syawaludintandry@yahoo.com
*/

class UpAPI
{
  // Get Data All Post's Ups
  public function getPostUps($post)
  {

    // Connect to the mysql database
    $link  =  mysqli_Connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
    mysqli_set_charset($link,'utf8');

    // Count data
    $sql_data_count  =  "SELECT count(up.id) as ups from user left join up on up.upper = user.id where up.post = $post";

    // excecute SQL statement
    $data_count =  mysqli_query($link, $sql_data_count);

    // SQL query
    $sql  =  "SELECT up.id, up.upper, up.date from user left join up on up.upper = user.id where up.post = $post order by up.date desc";

    // excecute SQL statement
    $result  =  mysqli_query($link, $sql);

    // Header For Json
    header('Content-Type: application/json');

    // die if SQL statement failed
    if (!$result) {
      echo'{"data":0,"error":2,"message":"404 not found"}';
      http_response_code(404);
      die(mysqli_error());
    } else {
      // Print results
      echo'{"data":[';
      for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        echo ($i > 0?',':'').json_encode(mysqli_fetch_object($result));
      }
      echo '],"total":'.json_encode(mysqli_fetch_object($data_count));
      echo '}';
      
    }

    // close mysql Connection
    mysqli_close($link);
  }

  // Create Up
  public function createUp()
  {
    // Get all input value
    $input  =  file_get_contents('php://input');

    // Parsing input to array
    parse_str($input, $data);

    // Connect to the mysql database
    $link  =  mysqli_Connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
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

    // SQL query
    $sql  =  "INSERT ignore into up set $set";

    // excecute SQL statement
    $result  =  mysqli_query($link, $sql);

    // Header For Json
    header('Content-Type: application/json');

    // die if SQL statement failed
    if (!$result) {
      echo'{"data":0,"error":2,"message":"404 not found"}';
      http_response_code(404);
      die(mysqli_error());
    } else {
      echo'{"data":0,"error":0,"message":"success"}';
    }

    // close mysql Connection
    mysqli_close($link);
  }

  // Deactive Up
  public function deleteUp($post, $up)
  {
    // Connect to the mysql database
    $link  =  mysqli_Connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
    mysqli_set_charset($link, 'utf8');

    // SQL query
    $sql  =  "DELETE from up where id = $up and post = $post";

    // excecute SQL statement
    $result  =  mysqli_query($link, $sql);

    // Header For Json
    header('Content-Type: application/json');

    // die if SQL statement failed
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
$UpAPI  =  new UpAPI;

// Call function based on HTTP method
switch ($method) {
  case 'GET':
    $UpAPI->getPostUps($request[2]);
    break;
  case 'DELETE':
    $UpAPI->deleteUp($request[2], $request[3]);
    break;
  case 'POST':
    $UpAPI->createUp();
    break;
}
