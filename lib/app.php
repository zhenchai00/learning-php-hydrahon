<?php 
namespace Learning;

/* if (! defined('ROOT_DIR')) {
    die('ROOT_DIR not defined!');
}
if (! defined('APP_DIR')) {
    die('APP_DIR not defined!');
}
if (! defined('LIB_DIR')) {
    die('LIB_DIR not defined!');
} */

define('ROOT_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR );
define('APP_DIR', ROOT_DIR . 'app/');
define('LIB_DIR', ROOT_DIR . 'lib/');

require_once(ROOT_DIR . '/vendor/autoload.php');

/**
 * This App class is a class for action and other common function 
 */
class App
{
    private static $instance = [];

    protected $fileName = __DIR__ . '/../myapp.log';

    protected $currentDate = '';

    protected function __construct()
    {
        
    }

    protected function __clone()
    {

    }

    public function __wakeup() 
    {
        throw new \Exception("Cannot unserialize singleton", 1);
    }

    /**
     * This getInstance() is singleton pattern to use declare instance of object
     *
     * @return object
     */
    public static function getInstance()
    {
        $subclass = static::class;
        if (!isset(self::$instance[$subclass])) {
            self::$instance[$subclass] = new static();
        }
        return self::$instance[$subclass];
    }

    /**
     * This dbBuilder() is used Hydrahon to create new sql query builder and get the table and other column 
     * of data in database 
     * 
     * https://github.com/ClanCats/Hydrahon
     *
     * @return mixed
     */
    /* protected function dbBuilder () : mixed
    {
        $dbConnection = new Db ('mysql', 'localhost', 'root', '', 'learning');

        $build = new \ClanCats\Hydrahon\Builder (
            'mysql',
            function ($query, $queryString, $queryParameters) use ($dbConnection) 
            {
                $statement = $dbConnection->prepare($queryString);
                $statement->execute($queryParameters);

                if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface)
                {
                    return $statement->fetchAll(\PDO::FETCH_ASSOC);
                } elseif($query instanceof \ClanCats\Hydrahon\Query\Sql\Insert)
                {
                    return $dbConnection->lastInsertId();
                } else 
                {
                    return $statement->rowCount();
                }
            }
        );   
    } */

    /**
     * This getDataTable is used method dbBuilder() to query out the table
     *
     * @param string $table Database Table 
     * @return void
     */
    /* protected function getDataTable($table) 
    {
        return $this->dbBuilder()->table($table);
    } */

    /**
     * This logging() is to log down the current action and other state
     *
     * @param string $text
     * @param string $alert
     * @return void
     */
    /* protected function logging ( string $alert, string $text) : void
    {
        $this->date = date('Y-m-d H:i:s');

        $fopen = fopen($this->fileName, 'a+') or die('Unable to open File! File does not exist');
        fwrite($fopen, ("[" . $this->date . "] - [" . $alert . "] - ". $text . "\r\n"));
        fclose($fopen);
    } */


}

?>