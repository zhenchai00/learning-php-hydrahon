<?php
namespace Learning\query;

class Listing 
{
    /**
     * This variable is App object
     *
     * @var object
     */
    public $app;

    public function __construct()
    {
        $this->app = \Learning\App::getInstance();
    }

    /**
     * This method is to set Table and return executed data
     *
     * @return mixed
     */
    public function setListing() : mixed
    {
        $employeeTable = $this->app->getDataTable('employee');
        return $employeeTable->select()->execute();
    }

    /**
     * This method is to get listing by using the setLising() method
     *
     * @return string
     */
    public function getListing() : string
    {
        $html = '<a href="index.php"><strong>HOME</strong></a><br><br>';
        $html .= '<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Created On</th>
                        </tr>
                    </thead>';
        
        $list = $this->setListing();
        foreach ($list as $value) {
            $html .= '<tbody>
                        <tr>
                            <td>' . $value['id'] . '</td>
                            <td>' . $value['firstname'] . '</td>
                            <td>' . $value['lastname'] . '</td>
                            <td>' . $value['createdon'] . '</td>
                        </tr>
                    </tbody>';
        }
        
        return $html;
    }
}

?>