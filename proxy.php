<?php
    if (!isset($_GET['url'])) die();
    $url = urldecode($_GET['url']);
    $url = 'http://' . str_replace('http://', '', $url); // Avoid accessing the file system

	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	$contents = curl_exec($ch);
	if (curl_errno($ch)) {
	  echo curl_error($ch);
	  echo "\n<br />";
	  $contents = '';
	} else {
	  curl_close($ch);
	}

	if (!is_string($contents) || !strlen($contents)) {
	echo "Failed to get contents.";
	$contents = '';
	}

	echo $contents;
?>