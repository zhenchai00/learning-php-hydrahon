<?php 
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app/brain.php');
require_once('handler/main.php');

use \Learning\handler\MainHandler;

$page = $_REQUEST['page'];

$action = new MainHandler($page);

if ($_POST['aot'] == 'create') {
    $result = $action->create($_POST['page'], $_POST['aot'], $_POST);
    $list = $action->getList();
    echo json_encode(['message' => $result, 'list' => $list]);

} elseif ($_POST['aot'] == 'update') {
    $result = $action->update($_POST['page'], $_POST['aot'], $_POST);
    $list = $action->getList();
    echo json_encode(['message' => $result, 'list' => $list]);

} elseif ($_POST['aot'] == 'delete') {
    $result = $action->delete($_POST['page'], $_POST['aot'], $_POST);
    $list = $action->getList();
    echo json_encode(['message' => $result, 'list' => $list]);
}

?>