<?php

require_once('../brain.php');
require_once(LIB_DIR . 'query/update.php');

use \Learning\query\UpdateListing;

$id = $_POST['employeeid'];
$firstname = $_POST['updatefirstname'];
$lastname = $_POST['updatelastname'];

$update = new UpdateListing();

echo $update->updateListing($id, $firstname, $lastname);
echo $app->getList();
?>