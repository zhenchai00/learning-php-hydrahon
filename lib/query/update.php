<?php
namespace Learning\query;

use \Learning\App;

class UpdateListing
{
    public $app;

    public function __construct()
    {
        $this->app = \Learning\App::getInstance();
        // $this->app->getDataTable('employee');
        // $this->log = Logging::getInstance();
        // $this->builderDb = new QueryDataStore;
    }

    public function setTable()
    {
        return $this->app->getDataTable('employee');
    }

    public function updateListing($id, $firstname, $lastname)
    {
        $date = date("Y-m-d H:i:s");

        if ($firstname == '' && $lastname == '') {
            return '<h3>Please insert employee name!</h3><br>
            <a href=\'../index.php#update\'>Retry</a><br>
            <a href=\'../index.php\'><strong>HOME</strong></a>';

        } elseif ($firstname == '' && isset($lastname)) {
            $query = $this->setTable()->update([
                'lastname' => $lastname,
                'createdon' => $date
            ])->where('id', $id);
            $query->execute();

            $this->app->writeLog('Update Employee\'s ID [' . $id . '] with lastname ', $this->app::INFO);

            return '<h3> Successful Update Employee\'s last name</h3><br>
            <a href=\'../index.php#update\'>Update Another Employee</a><br>
            <a href=\'../index.php\'><strong>HOME</strong></a>';

        } elseif (isset($firstname) && $lastname == '') {
            $query = $this->setTable()->update([
                'firstname' => $firstname,
                'createdon' => $date
            ])->where('id', $id);
            $query->execute();

            $this->app->writeLog('Update Employee\'s ID [' . $id . '] with firstname ', $this->app::INFO);

            return '<h3> Successful Update Employee\'s first name</h3><br>
            <a href=\'../index.php#update\'>Update Another Employee</a><br>
            <a href=\'../index.php\'><strong>HOME</strong></a>';

        } elseif (isset($firstname) && isset($lastname)) {
            $query = $this->setTable()->update([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'createdon' => $date
            ])->where('id', $id);
            $query->execute();

            $this->app->writeLog('Update Employee\'s ID [' . $id . '] with firstname and lastname ', $this->app::INFO);

            return '<h3> Successful Update Employee\'s first name and last name</h3><br>
            <a href=\'../index.php#update\'>Update Another Employee</a><br>
            <a href=\'../index.php\'><strong>HOME</strong></a>';
        }
    }
}
?>