<?php
namespace Learning;

include_once(__DIR__ . '/../../app/templates/header.php');
require_once(__DIR__ . '/../hydrahon.php');
require_once(__DIR__ . '/../log.php');

use Learning\QueryBuilder;
use Learning\Logging;

$id = $_POST['employeeid'];
$firstname = $_POST['updatefirstname'];
$lastname = $_POST['updatelastname'];
$date = date("Y-m-d H:i:s");

if (isset($_POST['submit'])) {
    $builderDb = new QueryBuilder;

    $employee = $builderDb->getBuilder()->table('employee');

    if ("" == $firstname && isset($lastname)) {
        $query = $employee->update(['lastname' => $lastname, 'createdon' => $date])->where('id', $id);
        $query->execute();
        echo '<h3> Successful Update Employee\'s last name</h3>';
        $logging = new Logging(' Update Employee\'s ID [' . $id . '] with lastname ');
        
    } elseif (isset($firstname) && "" == $lastname) {
        $query = $employee->update(['firstname' => $firstname, 'createdon' => $date])->where('id', $id);
        $query->execute();
        echo '<h3> Successful Update Employee\'s first name</h3>';
        $logging = new Logging(' Update Employee\'s ID [' . $id . '] with firstname ');
        
    } elseif (isset($firstname) && isset($lastname)) {
        $query = $employee->update(['firstname' => $firstname, 'lastname' => $lastname, 'createdon' => $date])->where('id', $id);
        $query->execute();
        echo '<h3> Successful Update Employee\'s first name and last name</h3>';
        $logging = new Logging(' Update Employee\'s ID [' . $id . '] with firstname and lastname ');
    }
}

echo '<a href="../../app/index.php"><strong>HOME</strong></a>';
include '../../app/templates/footer.php';
?>