<?php
namespace Learning\query;

use \Learning\App;

class InsertListing
{
    /**
     * This variable is App object
     *
     * @var object
     */
    protected $app;

    public function __construct()
    {
        $this->app = \Learning\App::getInstance();
    }

    public function setTable()
    {
        return $this->app->getDataTable('employee');
    }

    public function insertListing($firstname, $lastname)
    {
        if ($firstname == '' && $lastname == '') {
            return '<h3>Please insert employee name!</h3><br>
            <a href=\'../index.php#create\'>Retry</a><br>
            <a href=\'../index.php\'><strong>HOME</strong></a>';
        }

        $query = $this->setTable()->insert([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'createdon' => date("Y-m-d H:i:s"),
        ]);
        $query->execute();

        $this->app->writeLog('Insert Data to Employee Table ', $this->app::INFO);

        return '<h3>' . $firstname . ' successful added!</h3><br>
        <a href=\'../index.php#create\'>Create Another Employee</a><br>
        <a href=\'../index.php\'><strong>HOME</strong></a>';
    }
}
?>