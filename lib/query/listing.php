<?php
namespace Learning;

include_once(__DIR__ . '/../../app/templates/header.php');
require_once(__DIR__ . '/../hydrahon.php');
require_once(__DIR__ . '/../log.php');

use Learning\QueryDataStore;

echo '<table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Created On</th>
            </tr>
        </thead>';

$builderDb = new QueryDataStore;
$employeeTable = $builderDb->getDataTable('employee');
$query = $employeeTable->select()->execute();

foreach ($query as $value) {
    echo '<tbody>
            <tr>
                <td>' . $value['id'] . '</td>
                <td>' . $value['firstname'] . '</td>
                <td>' . $value['lastname'] . '</td>
                <td>' . $value['createdon'] . '</td>
            </tr>
        </tbody>';
}


echo '<a href="../../app/index.php"><strong>HOME</strong></a><br><br>';

include '../../app/templates/footer.php';
?>