<?php
// tutorial from https://www.youtube.com/watch?v=dlGtSoigdB0
use Learning\apihandler\Post;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../brain.php');

$post = new Post();
$data = json_decode(file_get_contents("php://input"));
$post->id = $data->id;
$post->firstName = $data->firstname;
$post->lastName = $data->lastname;

if ($post->update()) {
    echo json_encode(['message' => 'Successfully updated record']);
} else {
    echo json_encode(['message' => 'Failed to update record']);
}

?>