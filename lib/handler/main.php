<?php
namespace Learning\handler;

/**
 * This class is main handler to handle different module of data 
 */
class MainHandler
{
    private $class = '';

    private $page = '';

    public function __construct($page)
    {
        $this->page = $page;
        $this->class = 'Learning\handler\\' . $this->page . 'Handler';
    }

    /**
     * This method is to pass the parameter to do the CRUD action
     *
     * @param   string  $page       String for the page which is to identify data table
     * @param   string  $aot        For identify action create, update or delete
     * @param   array   $params     Parameters for create, update or delete the record
     * @return  string  Result from the handler action
     */
    public function doAction(string $page, string $aot, array $params) : string
    {
        require_once $page."_handler.php";
        $class = new $this->class;
        
        if ($params['action'] == 'create') {
            return $class->insertListing($params);
        } elseif ($params['action'] == 'update') {
            return $class->updateListing($params);
        } elseif ($params['action'] == 'delete') {
            return $class->deleteListing($params);
        }
    }

    /**
     * This method is to get listing from that particular table
     *
     * @return string
     */
    public function getList() : string
    {
        require_once $this->page."_handler.php";
        $class = new $this->class;
        return $class->getListing();
    }

    /**
     * This method is to create new record 
     *
     * @param   string  $page       String for the page which is to identify data table
     * @param   string  $aot        For identify action create, update or delete
     * @param   array   $params     Parameters for create, update or delete the record
     * @return  string  Result from the doAction()
     */
    public function create(string $page, string $aot, array $params) : string
    {
        return $this->doAction($page, $aot, $params);
    }

    /**
     * This method is to update existing record 
     *
     * @param   string  $page       String for the page which is to identify data table
     * @param   string  $aot        For identify action create, update or delete
     * @param   array   $params     Parameters for create, update or delete the record
     * @return  string  Result from the doAction()
     */
    public function update(string $page, string $aot, array $params) : string
    {
        return $this->doAction($page, $aot, $params);
    }

    /**
     * This method is to delete existing record 
     *
     * @param   string  $page       String for the page which is to identify data table
     * @param   string  $aot        For identify action create, update or delete
     * @param   array   $params     Parameters for create, update or delete the record
     * @return  string  Result from the doAction()
     */
    public function delete(string $page, string $aot, array $params) : string
    {
        return $this->doAction($page, $aot, $params);
    }
}
?>