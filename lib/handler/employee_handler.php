<?php
namespace Learning\handler;

class EmployeeHandler
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
        return $this->app->getDataTable('employee');
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
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Created On</th>
                            <th>Modified On</th>
                        </tr>
                    </thead>';
        
        $list = $this->getTable()->select()->execute();
        foreach ($list as $value) {
            $html .= '<tbody>
                        <tr>
                            <td>' . $value['emp_id'] . '</td>
                            <td>' . $value['emp_firstname'] . '</td>
                            <td>' . $value['emp_lastname'] . '</td>
                            <td>' . $this->app->dateTimeConvertToAsiaKL($value['emp_createdon']) . '</td>
                            <td>' . $this->app->dateTimeConvertToAsiaKL($value['emp_modifiedon']) . '</td>
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
    public function insertListing($params) : string
    {
        if ($params['firstname'] == '' && $params['lastname'] == '') {
            return '<h3>Please insert employee name!</h3><br>
            <a href=\'index.php?page=employee&aot=create#create\'>Retry</a><br>
            <a href=\'index.php?page=employee&aot=list#list\'><strong>HOME</strong></a>';
        }

        $query = $this->getTable()->insert([
            'emp_firstname' => $params['firstname'],
            'emp_lastname' => $params['lastname'],
            'emp_createdon' => $this->date,
            'emp_modifiedon' => $this->date,
        ]);
        $query->execute();

        $this->app->writeLog('Insert Data to Employee Table ', $this->app::INFO);

        return '<h3>' . $params['firstname'] . ' successful added!</h3><br>
        <a href=\'index.php?page=employee&aot=create#create\'>Create Another Employee</a><br>
        <a href=\'index.php?page=employee&aot=list#list\'><strong>HOME</strong></a>';
    }

    /**
     * This method is to update particular record by get record id
     *
     * @param   array   $params Parameter from the form post
     * @return  string
     */
    public function updateListing($params) : string
    {
        if ($params['firstname'] == '' && $params['lastname'] == '') {
            return '<h3>Please insert employee name!</h3><br>
            <a href=\'index.php?page=employee&aot=update#update\'>Retry</a><br>
            <a href=\'index.php?page=employee&aot=list#list\'><strong>HOME</strong></a>';

        } elseif ($params['firstname'] == '' && isset($params['lastname'])) {
            $query = $this->getTable()->update([
                'emp_lastname' => $params['lastname'],
                'emp_modifiedon' => $this->date
            ])->where('emp_id', $params['id']);
            $query->execute();

            $this->app->writeLog('Update Employee\'s ID [' . $params['id'] . '] with lastname ', $this->app::INFO);

            return '<h3> Successful Update Employee\'s last name</h3><br>
            <a href=\'index.php?page=employee&aot=update#update\'>Update Another Employee</a><br>
            <a href=\'index.php?page=employee&aot=list#list\'><strong>HOME</strong></a>';

        } elseif (isset($params['firstname']) && $params['lastname'] == '') {
            $query = $this->getTable()->update([
                'emp_firstname' => $params['firstname'],
                'emp_modifiedon' => $this->date
            ])->where('emp_id', $params['id']);
            $query->execute();

            $this->app->writeLog('Update Employee\'s ID [' . $params['id'] . '] with firstname ', $this->app::INFO);

            return '<h3> Successful Update Employee\'s first name</h3><br>
            <a href=\'index.php?page=employee&aot=update#update\'>Update Another Employee</a><br>
            <a href=\'index.php?page=employee&aot=list#list\'><strong>HOME</strong></a>';

        } elseif (isset($params['firstname']) && isset($params['lastname'])) {
            $query = $this->getTable()->update([
                'emp_firstname' => $params['firstname'],
                'emp_lastname' => $params['lastname'],
                'emp_modifiedon' => $this->date
            ])->where('emp_id', $params['id']);
            $query->execute();

            $this->app->writeLog('Update Employee\'s ID [' . $params['id'] . '] with firstname and lastname ', $this->app::INFO);

            return '<h3> Successful Update Employee\'s first name and last name</h3><br>
            <a href=\'index.php?page=employee&aot=update#update\'>Update Another Employee</a><br>
            <a href=\'index.php?page=employee&aot=list#list\'><strong>HOME</strong></a>';
        }
    }

    /**
     * This method is to delete particular record by get record id
     *
     * @param   array   $params Parameter from the form post
     * @return  string
     */
    public function deleteListing($params) : string
    {
        if ("" == $params['id']) {
            return '<h3>Please insert data on text box</h3><br>
            <a href=\'index.php?page=employee&aot=delete#delete\'>Retry</a><br>
            <a href=\'index.php?page=employee&aot=list#list\'><strong>HOME</strong></a>';
        }
        
        $query = $this->getTable()->delete()->where('emp_id', $params['id']);
        $query->execute();

        $this->app->writeLog('Deleted Employee ID [' . $params['id'] . ']', $this->app::INFO);
        
        return '<h3>Employee ID [' . $params['id'] . '] Successful Removed</h3><br>
        <a href=\'index.php?page=employee&aot=delete#delete\'>Delete Another Employee</a><br> 
        <a href=\'index.php?page=employee&aot=list#list\'><strong>HOME</strong></a>';
    }
}

?>