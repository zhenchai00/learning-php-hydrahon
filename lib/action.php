<?php 
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app/brain.php');
require_once(LIB_DIR . 'CRUD.php');

use \Learning\CRUDListing;

$actionCRUD = new CRUDListing();

if ($_POST['action'] == 'create') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    
    $result = $actionCRUD->insertListing($firstname, $lastname);
    $list = $app->getList();
    echo json_encode(['message' => $result, 'list' => $list]);

} elseif ($_POST['action'] == 'update') {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $result = $actionCRUD->updateListing($id, $firstname, $lastname);
    $list = $app->getList();
    echo json_encode(['message' => $result, 'list' => $list]);
} elseif ($_POST['action'] == 'delete') {
    $id = $_POST['id'];

    $result = $actionCRUD->deleteListing($id);
    $list = $app->getList();
    echo json_encode(['message' => $result, 'list' => $list]);

}

?>