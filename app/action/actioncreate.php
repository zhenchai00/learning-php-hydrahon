<?php
namespace Learning\action;

require_once('../brain.php');
require_once(LIB_DIR . 'query/insert.php');

use \Learning\query\InsertListing;

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$insert = new InsertListing();

echo $insert->insertListing($firstname, $lastname);
?>