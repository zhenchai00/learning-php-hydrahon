<?php
namespace Learning;

use DateTime;
use DateTimeZone;

class CRUDListing
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
     * This method will add new record to database 
     *
     * @param  string   $firstname  User input employee's first name
     * @param  string   $lastname   User input employee's last name
     * 
     * @return string   Result after insert data to database
     */
    public function insertListing(string $firstname, string $lastname) : string
    {
        if ($firstname == '' && $lastname == '') {
            return '<h3>Please insert employee name!</h3><br>
            <a href=\'index.php#create\'>Retry</a><br>
            <a href=\'index.php\'><strong>HOME</strong></a>';
        }

        $query = $this->getTable()->insert([
            'emp_firstname' => $firstname,
            'emp_lastname' => $lastname,
            'emp_createdon' => $this->date,
            'emp_modifiedon' => $this->date,
        ]);
        $query->execute();

        $this->app->writeLog('Insert Data to Employee Table ', $this->app::INFO);

        return '<h3>' . $firstname . ' successful added!</h3><br>
        <a href=\'index.php#create\'>Create Another Employee</a><br>
        <a href=\'index.php\'><strong>HOME</strong></a>';
    }

    /**
     * This method will update the an exiting record 
     *
     * @param   string  $id            Existing record's id
     * @param   string   $firstname     Value should be updated for first name 
     * @param   string   $lastname      Value should be updated for last name 
     * 
     * @return  string  Result after updated an exiting record
     */
    public function updateListing(string $id, string $firstname, string $lastname) : string
    {
        if ($firstname == '' && $lastname == '') {
            return '<h3>Please insert employee name!</h3><br>
            <a href=\'index.php#update\'>Retry</a><br>
            <a href=\'index.php\'><strong>HOME</strong></a>';

        } elseif ($firstname == '' && isset($lastname)) {
            $query = $this->getTable()->update([
                'emp_lastname' => $lastname,
                'emp_modifiedon' => $this->date
            ])->where('emp_id', $id);
            $query->execute();

            $this->app->writeLog('Update Employee\'s ID [' . $id . '] with lastname ', $this->app::INFO);

            return '<h3> Successful Update Employee\'s last name</h3><br>
            <a href=\'index.php#update\'>Update Another Employee</a><br>
            <a href=\'index.php\'><strong>HOME</strong></a>';

        } elseif (isset($firstname) && $lastname == '') {
            $query = $this->getTable()->update([
                'emp_firstname' => $firstname,
                'emp_modifiedon' => $this->date
            ])->where('emp_id', $id);
            $query->execute();

            $this->app->writeLog('Update Employee\'s ID [' . $id . '] with firstname ', $this->app::INFO);

            return '<h3> Successful Update Employee\'s first name</h3><br>
            <a href=\'index.php#update\'>Update Another Employee</a><br>
            <a href=\'index.php\'><strong>HOME</strong></a>';

        } elseif (isset($firstname) && isset($lastname)) {
            $query = $this->getTable()->update([
                'emp_firstname' => $firstname,
                'emp_lastname' => $lastname,
                'emp_modifiedon' => $this->date
            ])->where('emp_id', $id);
            $query->execute();

            $this->app->writeLog('Update Employee\'s ID [' . $id . '] with firstname and lastname ', $this->app::INFO);

            return '<h3> Successful Update Employee\'s first name and last name</h3><br>
            <a href=\'index.php#update\'>Update Another Employee</a><br>
            <a href=\'index.php\'><strong>HOME</strong></a>';
        }
    }

    /**
     * This method is the delete or drop the existing record
     *
     * @param    string     $id    Existing record's id that wanted to delete
     * 
     * @return   string     Result after deleted existing record
     */
    public function deleteListing(string $id) : string
    {
        if ("" == $id) {
            return '<h3>Please insert data on text box</h3><br>
            <a href=\'index.php#delete\'>Retry</a><br>
            <a href=\'index.php\'><strong>HOME</strong></a>';
        }
        
        $query = $this->getTable()->delete()->where('emp_id', $id);
        $query->execute();

        $this->app->writeLog('Deleted Employee ID [' . $id . ']', $this->app::INFO);
        
        return '<h3>Employee ID [' . $id . '] Successful Removed</h3><br>
        <a href=\'index.php#delete\'>Delete Another Employee</a><br> 
        <a href=\'index.php\'><strong>HOME</strong></a>';
    }
}

?>