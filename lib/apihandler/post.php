<?php
//php api tutorial https://www.youtube.com/watch?v=dlGtSoigdB0
namespace Learning\apihandler;

use Learning\App;
use phpDocumentor\Reflection\Types\Boolean;

class Post
{
    private $app;
    private $date;

    public $id;
    public $firstName;
    public $lastName;
    public $createdOn;
    public $modifiedOn;

    public function __construct()
    {
        $this->app = App::getInstance();
        $this->date = date('Y-m-d H:i:s');
    }

    protected function getTable(): object
    {
        return $this->app->getDataTable('employee');
    }

    public function read(): string
    {
        $list = $this->getTable()->select()->orderBy('emp_id', 'desc')->execute();
        if (empty($list)) return json_encode(['message' => 'No record found']);
        return json_encode($list);
    }

    public function readSingle(): string
    {
        $list = $this->getTable()->select()->where('emp_id', $this->id)->orderBy('emp_id', 'desc')->execute();
        if (empty($list)) return json_encode(['message' => 'No record found']);
        return json_encode($list);
    }

    public function create(): bool
    {
        $query = $this->getTable()->insert([
            'emp_firstname' => $this->firstName,
            'emp_lastname' => $this->lastName,
            'emp_createdon' => $this->date,
            'emp_modifiedon' => $this->date,
        ]);

        if ($query->execute()) return true;
        echo 'Error occur ';
        // throw new \Exception("Error processing query", 1);
        return false;
    }

    public function update(): bool
    {
        $query = $this->getTable()->update([
            'emp_firstname' => $this->firstName,
            'emp_lastname' => $this->lastName,
            'emp_modifiedon' => $this->date,
        ])->where('emp_id', $this->id);

        if ($query->execute()) return true;
        echo 'Error occur ';
        // throw new \Exception("Error processing query", 1);
        return false;
    }

    public function delete(): bool
    {
        $query = $this->getTable()->delete()->where('emp_id', $this->id);

        if ($query->execute()) return true;
        echo 'Error occur ';
        // throw new \Exception("Error processing query", 1);
        return false;
    }
}
?>