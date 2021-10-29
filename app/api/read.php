<?php
// tutorial from https://www.youtube.com/watch?v=dlGtSoigdB0
use Learning\apihandler\Post;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../brain.php');

$post = new Post();
$result = $post->read();
echo $result;

?>