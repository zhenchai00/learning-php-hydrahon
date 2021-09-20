<?php
namespace Learning\query;

use \Learning\App;

class DeleteListing
{
    protected $app;

    public function __construct()
    {
        $this->app = \Learning\App::getInstance();
    }

    public function setTable()
    {
        return $this->app->getDataTable('employee');
    }

    public function deleteListing($id) 
    {
        if ("" == $id) {
            return 'h3>Please insert data on text box</h3><br>
            <a href=\'../index.php#delete\'>Retry</a><br>
            <a href=\'../index.php\'><strong>HOME</strong></a>';
        }
        
        $query = $this->setTable()->delete()->where('id', $id);
        $query->execute();

        $this->app->writeLog('Deleted Employee ID [' . $id . ']', $this->app::INFO);
        
        return '<h3> Employee ID [' . $id . '] Successful Removed </h3><br>
        <a href=\'../index.php#delete\'>Delete Another Employee</a><br> 
        <a href=\'../index.php\'><strong>HOME</strong></a>';
    }
}
?>