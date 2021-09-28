<?php
namespace Learning\handler;

class DepartmentHandler
{
    /**
     * This variable is App object
     *
     * @var object
     */
    public $app;

    /**
     * The Current date time 
     *
     * @var date
     */
    protected $date;

    public function __construct()
    {
        $this->app = \Learning\App::getInstance();
        $this->date = date('Y-m-d H:i:s');
    }

    /**
     * Get the database table with predefined table name
     *
     * @return object
     */
    protected function getTable() : object
    {
        return $this->app->getDataTable('department');
    }

    /**
     * This method returns the listing table 
     *
     * @return string
     */
    public function getListing() : string
    {
        $html = '<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Department Name</th>
                            <th>Employee ID</th>
                            <th>Created On</th>
                            <th>Modified On</th>
                        </tr>
                    </thead>';
        
        $list = $this->getTable()->select()->execute();
        foreach ($list as $value) {
            $html .= '<tbody>
                        <tr>
                            <td>' . $value['dep_id'] . '</td>
                            <td>' . $value['dep_name'] . '</td>
                            <td>' . $value['dep_employeeid'] . '</td>
                            <td>' . $this->app->dateTimeConvertToAsiaKL($value['dep_createdon']) . '</td>
                            <td>' . $this->app->dateTimeConvertToAsiaKL($value['dep_modifiedon']) . '</td>
                        </tr>
                    </tbody>';
        }
        return $html;
    }

    /**
     * This method is to insert new record to table
     *
     * @param   array   $params Parameter from the form post
     * @return  string
     */
    public function insertListing(array $params) : string
    {
        $html = "<script>
                    var hash = location.hash.substr(1);
                    $(document).ready(function() {
                        document.getElementById(\"retryCreate\").onclick = function () {
                            console.log('REtry Create Clicked');
                            $('#content').load('form/' + hash + '/' + page + '_' + aot + '.php?page=' + page + '&aot=' + aot);
                        };
                    });
                </script>";
        
        if ($params['departmentName'] == '' && $params['id'] == '') {
            return $html . '<h3>Please insert employee id and department name!</h3><br>
            <a id=\'retryCreate\' href=\'index.php?page=department&aot=create#create\'>Retry</a><br>
            <a href=\'index.php?page=department&aot=list#list\'><strong>HOME</strong></a>';
        }

        $query = $this->getTable()->insert([
            'dep_name' => $params['departmentName'],
            'dep_employeeid' => $params['id'],
            'dep_createdon' => $this->date,
            'dep_modifiedon' => $this->date,
        ]);
        $query->execute();

        $this->app->writeLog('Insert Data to Department Table ', $this->app::INFO);

        return $html . '<h3>' . $params['departmentName'] . ' successful added!</h3><br>
        <a id=\'retryCreate\' href=\'index.php?page=department&aot=create#create\'>Create Another Employee</a><br>
        <a href=\'index.php?page=department&aot=list#list\'><strong>HOME</strong></a>';
    }

    /**
     * This method is to update record by get id 
     *
     * @param   array   $params Parameter from the form post
     * @return  string
     */
    public function updateListing(array $params) : string
    {
        $html = "<script>
                    var hash = location.hash.substr(1);
                    $(document).ready(function() {
                        document.getElementById(\"retryUpdate\").onclick = function () {
                            console.log('REtry Update Clicked');
                            $('#content').load('form/' + hash + '/' + page + '_' + aot + '.php?page=' + page + '&aot=' + aot);
                        };
                    });
                </script>";

        if ($params['id'] == '' && $params['departmentName'] == '') {
            return $html . '<h3>Please insert employee id and employee\'s department name !</h3><br>
            <a id=\'retryUpdate\' href=\'index.php?page=department&aot=update#update\'>Retry</a><br>
            <a href=\'index.php?page=department&aot=list#list\'><strong>HOME</strong></a>';

        } elseif ($params['id'] == '' && isset($param['departmentName'])) {
            return $html . '<h3>Please insert employee id!</h3><br>
            <a id=\'retryUpdate\' href=\'index.php?page=department&aot=update#update\'>Retry</a><br>
            <a href=\'index.php?page=department&aot=list#list\'><strong>HOME</strong></a>';

        } elseif (isset($params['id']) && $params['departmentName'] == '') {
            return $html . '<h3>Please insert employee\'s department!</h3><br>
            <a id=\'retryUpdate\' href=\'index.php?page=department&aot=update#update\'>Retry</a><br>
            <a href=\'index.php?page=department&aot=list#list\'><strong>HOME</strong></a>';

        } elseif (isset($params['id']) && isset($params['departmentName'])) {
            $query = $this->getTable()->update([
                'dep_name' => $params['departmentName'],
                'dep_modifiedon' => $this->date
            ])->where('dep_employeeid', $params['id']);
            $query->execute();

            $this->app->writeLog('Update Employee\'s Department by Employee\'s ID [' . $params['id'] . ']', $this->app::INFO);

            return $html . '<h3> Successful Update  Employee\'s Department by Employee\'s ID ' . $params['id'] . '</h3><br>
            <a id=\'retryUpdate\' href=\'index.php?page=department&aot=update#update\'>Update Another Employee</a><br>
            <a href=\'iindex.php?page=department&aot=list#list\'><strong>HOME</strong></a>';
        }
    }

    /**
     * This method is to delete record from table by get id
     *
     * @param   array   $params Parameter from the form post
     * @return  string
     */
    public function deleteListing(array $params) : string
    {
        $html = "<script>
                    var hash = location.hash.substr(1);
                    $(document).ready(function() {
                        document.getElementById(\"retryDelete\").onclick = function () {
                            console.log('REtry Delete Clicked');
                            $('#content').load('form/' + hash + '/' + page + '_' + aot + '.php?page=' + page + '&aot=' + aot);
                        };
                    });
                </script>";

        if ("" == $params['id']) {
            return $html . '<h3>Please insert data on text box</h3><br>
            <a id=\'retryDelete\' href=\'index.php?page=employee&aot=delete#delete\'>Retry</a><br>
            <a href=\'index.php?page=department&aot=list#list\'><strong>HOME</strong></a>';
        }
        
        $query = $this->getTable()->delete()->where('dep_employeeid', $params['id']);
        $query->execute();

        $this->app->writeLog('Deleted Employee ID [' . $params['id'] . ']', $this->app::INFO);
        
        return $html . '<h3>Employee ID [' . $params['id'] . '] Successful Removed</h3><br>
        <a id=\'retryDelete\' href=\'index.php?page=employee&aot=delete#delete\'>Delete Another Employee</a><br> 
        <a href=\'index.php?page=department&aot=list#list\'><strong>HOME</strong></a>';
    }
}

?>