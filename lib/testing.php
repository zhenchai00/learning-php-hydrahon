<?php

require(__DIR__ . '../vendor/autoload.php');
require 'hydrahon.php';

use Learning\QueryDataStore;

/**
 * Query Table 
 */
$builderDb = new QueryDataStore;
$employee = $builderDb->getDataTable('employee');

/**
 * Insert data 
 * https://clancats.io/hydrahon/master/sql-query-builder/insert
 */
$q = $employee->insert([
    ['firstname' => 'Melvin', 'lastname' => 'Ng', 'createdon' => date("Y-m-d H:i:s")],
    ['firstname' => 'Melvin', 'lastname' => 'Nice', 'createdon' => date("Y-m-d H:i:s")],
    ['firstname' => 'Batman', 'lastname' => 'Bad Bad', 'createdon' => date("Y-m-d H:i:s")]
]);

/**
 * Update data 
 * https://clancats.io/hydrahon/master/sql-query-builder/update
 */
$query = $employee->update(['lastname' => 'Something'])->where('firstname', 'Batman')->execute();


$stg = $employee->select()->count();
echo '<pre>';
echo json_encode($stg);
echo '<br><br>';
var_dump($stg);


?>
