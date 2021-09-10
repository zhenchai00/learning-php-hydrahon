<?php
namespace Learning;


include_once(__DIR__ . '/../../app/templates/header.php');
require_once(__DIR__ . '/../hydrahon.php');
require_once(__DIR__ . '/../log.php');

use \Learning\QueryDataStore;
use \Learning\Logging;

$log = Logging::getInstance();

$id = $_POST['employeeid'];
if ("" == $id) {
    echo '<h3>Please insert data on text box</h3>';
} else {

    $builderDb = new QueryDataStore;
    $employee = $builderDb->getDataTable('employee');
    $query = $employee->delete()->where('id', $id);
    $query->execute();

    $log->writeLog('Deleted Employee ID [' . $id . ']\n', $log::INFO);
    echo '<h3> Employee ID [' . $id . '] Successful Removed </h3>';    
}

$query = $employee->select()->where('id', $id)->execute();
$log->writeLog(' Delete Employee ID [' . $id . '] ' . json_encode($query) . ' ', $log::INFO);

echo '<a href="../../app/index.php"><strong>HOME</strong></a>';

include '../../app/templates/footer.php';
?>