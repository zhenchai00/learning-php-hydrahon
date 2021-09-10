<?php
namespace Learning;

include_once(__DIR__ . '/../../app/templates/header.php');
require_once(__DIR__ . '/../hydrahon.php');
require_once(__DIR__ . '/../log.php');

use \Learning\QueryBuilder;
use \Learning\Logging;

$id = $_POST['employeeid'];
if ("" == $id) {
    echo '<h3>Please insert data on text box</h3>';
} else {
    $builderDb = new QueryBuilder;
    $employee = $builderDb->getBuilder()->table('employee');
    $query = $employee->delete()->where('id', $id);
    $query->execute();

    $logging = new Logging('Delete Employee ID [' . $id . ']\n');
    echo '<h3> Employee ID [' . $id . '] Successful Removed </h3>';    
}

$query = $employee->select()->where('id', $id)->execute();
$logging = new Logging(' Delete Employee ID [' . $id . '] ' . json_encode($query) . ' ');

echo '<a href="../../app/index.php"><strong>HOME</strong></a>';

include '../../app/templates/footer.php';
?>