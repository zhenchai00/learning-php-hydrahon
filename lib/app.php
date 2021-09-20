<?php 
namespace Learning;

if (! defined("APP_DIR")) {
    die('APP_DIR not defined!');
}
if (! defined("LIB_DIR")) {
    die('LIB_DIR not defined!');
}

require_once(dirname(LIB_DIR) . DIRECTORY_SEPARATOR . 'vendor/autoload.php');

use Learning\query\Listing;

/**
 * This App class is a class for action and other common function.
 * Main singleton application class. This class can be accessed anywhere with 
 * the call to App::getInstance() method
 */
class App
{
    private static $instance = [];

    protected $fileHandle;

    protected $currentDate = '';

    const INFO = "INFO";
    const DEBUG = "DEBUG";
    const ERROR = "ERROR";

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
    protected function dbBuilder() : mixed
    {
        $dbConnection = new Db ('mysql', 'localhost', 'root', '', 'learning');

        $build = new \ClanCats\Hydrahon\Builder (
            'mysql',
            function ($query, $queryString, $queryParameters) use ($dbConnection) 
            {
                try {
                    $statement = $dbConnection->prepare($queryString);
                    $statement->execute($queryParameters);
                    if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface) {
                        return $statement->fetchAll(\PDO::FETCH_ASSOC);
                    } elseif ($query instanceof \ClanCats\Hydrahon\Query\Sql\Insert)
                    {
                        return $dbConnection->lastInsertId();
                    } else 
                    {
                        return $statement->rowCount();
                    } 
                } catch (\Exception $e) {
                    echo 'Exception in DBConnector class';
                    throw new \Exception('Error executing DB Query', 0, $e);
                }
            }
        );
        return $build;
    }

    /**
     * This getDataTable is used method dbBuilder() to query out the table
     *
     * @param  string  $table    Database Table 
     * @param  string  $table    Database Table 
     * @return mixed
     */
    public function getDataTable(string $table) : mixed
    {
        return $this->dbBuilder()->table($table);
    }

    /**
     * Initialize Log file 
     *
     * @return void
     */
    public function initLog() : void
    {
        $this->fileHandle = fopen(dirname(LIB_DIR) . DIRECTORY_SEPARATOR . 'myapp.log', 'a+');
    }

    /**
     * Write and close the Log file
     *
     * @param string $text Message to log 
     * @param string $alert Message type
     * @return void
     */
    public function writeLog(string $text, string $alert) : void
    {
        $this->initLog();
        $date = date('Y-m-d H:i:s');
        fwrite($this->fileHandle, ("[" . $date . "] - [" . $alert . "] - " . $text . "\r\n"));
        fclose($this->fileHandle);
    }

    /**
     * This is to get listing and show at brain.php 
     *
     * @return mixed
     */
    public function getList() : mixed
    {
        $list =  new Listing();
        return $list->getListing();
    }
}

?>