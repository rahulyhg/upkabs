<?php
/**
This controller has a copyright tandrysyawaludin at 2017 for commercial.
name: tandrys syawaludin soedijanto
email: syawaludintandry@yahoo.com
*/

class CommentAPI
{
  // Get Notifications Comments To User
  public function getCommentsToUser($user)
  {
    // Connect to the mysql database
    $link  =  mysqli_Connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
    mysqli_set_charset($link,'utf8');

    // SQL query
    $sql_data_count = "SELECT count(comment.id) as unread from user left join comment on comment.commentator = user.id inner join post on comment.post = post.id where comment.commentator != $user and  post.creator = $user and  comment.seen = 0 and comment.deactive = 0";

    // excecute SQL statement
    $data_count  =  mysqli_query($link, $sql_data_count);

    // SQL query
    $sql_result  =  "SELECT comment.id as comment, comment.commentator, post.id, comment.text, post.title, comment.date, user.name from user left join comment on comment.commentator = user.id inner join post on comment.post = post.id where comment.commentator != $user and post.creator = $user and  comment.seen = 0 and comment.deactive = 0 order by comment.date desc";

    // excecute SQL statement
    $result  =  mysqli_query($link, $sql_result);

    // Header For Json
    header('Content-Type: application/json');

    // die if SQL statement failed
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
      echo '],"total":'.json_encode(mysqli_fetch_object($data_count));
      echo '}';
    }

    // close mysql Connection
    mysqli_close($link);
  }

  // Deactive Notifications Comments To User
  public function deactiveCommentsToUser($user)
  {
    // Connect to the mysql database
    $link  =  mysqli_Connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
    mysqli_set_charset($link,'utf8');

    // SQL query
    $sql_result  =  "UPDATE comment, post set comment.seen = 1 where comment.commentator != $user and post.creator = $user";

    // excecute SQL statement
    $result  =  mysqli_query($link, $sql_result);

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

  // Get Data All Post's Comments
  public function getPostComments($post)
  {

    // Connect to the mysql database
    $link  =  mysqli_Connect('localhost', 'upkabsco_admin', 'Soedijant0',  'upkabsco_db');
    mysqli_set_charset($link,'utf8');

    // Count data
    $sql_data_count  =  "SELECT count(comment.id) as comments from user left join comment on comment.commentator = user.id where comment.post = $post and comment.deactive = 0";

    // excecute SQL statement
    $data_count =  mysqli_query($link, $sql_data_count);

    // SQL query
    $sql  =  "SELECT comment.id, comment.text, comment.commentator, comment.date, user.name from user left join comment on comment.commentator = user.id where comment.post = $post and comment.deactive = 0 order by comment.date desc";

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

  // Create Comment
  public function createComment()
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
    $sql  =  "INSERT ignore into comment set $set";

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

  // Deactive Comment
  public function deactiveComment()
  {
    // Set variable
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
    $sql  =  "update comment set deactive = 1 where $set";

    // excecute SQL statement
    $result  =  mysqli_query($link,$sql);

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
$CommentAPI  =  new CommentAPI;

// Call function based on HTTP method
switch ($method) {
  case 'GET':
    if (strcmp($request[3], "notification") == 0) {
      $CommentAPI->getCommentsToUser($request[4]);
    }else{
      $CommentAPI->getPostComments($request[3]);
    }
    break;
  case 'PUT':
    if (strcmp($request[3], "notification") == 0) {
      $CommentAPI->deactiveCommentsToUser($request[4]);
    }else{
      $CommentAPI->deactiveComment();
    }
    break;
  case 'POST':
    $CommentAPI->createComment();
    break;
}