<?php

require_once('../brain.php');
require_once(LIB_DIR . 'query/delete.php');

use \Learning\query\DeleteListing;

$id = $_POST['employeeid'];

$delete = new DeleteListing();

echo $delete->deleteListing($id);
?>