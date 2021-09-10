<?php
namespace Learning;

include_once(__DIR__ . '/../../app/templates/header.php');
require_once(__DIR__ . '/../hydrahon.php');
require_once(__DIR__ . '/../log.php');

use \Learning\QueryBuilder;
use \Learning\Logging;

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

if ("" == $firstname && "" == $lastname) {
    echo '<h3>Please insert data on text box</h3>';
} else {
    $builderDb = new QueryBuilder;

    $tables = $builderDb->getBuilder()->table('employee');
    $query = $tables->insert([
        'firstname' => $firstname, 
        'lastname' => $lastname, 
        'createdon' => date("Y-m-d H:i:s")
    ]);
    $query->execute();

    $logging = new Logging(' Insert data to Employee Table ');

    echo '<h3>' . $firstname . ' Successful Added </h3>';

}


echo '<a href="../../app/index.php"><strong>HOME</strong></a>';

include '../../app/templates/footer.php';
?>