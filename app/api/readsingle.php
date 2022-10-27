<?php
// tutorial from https://www.youtube.com/watch?v=dlGtSoigdB0
use Learning\apihandler\Post;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../brain.php');

$post = new Post();
// $post->id = isset($_GET['id']) ? $_GET['id'] : die();
$post->id = $_GET['id'];
$result = $post->readSingle();
echo $result;

?>