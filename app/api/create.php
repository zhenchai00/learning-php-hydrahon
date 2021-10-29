<?php
// tutorial from https://www.youtube.com/watch?v=dlGtSoigdB0
use Learning\apihandler\Post;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../brain.php');

$post = new Post();
$data = json_decode(file_get_contents("php://input"));
$post->firstName = $data->firstname;
$post->lastName = $data->lastname;

if ($post->create()) {
    echo json_encode(['message' => 'Successfully added record']);
} else {
    echo json_encode(['message' => 'Failed to add record']);
}

?>