<?php 
namespace Learning;

if (! defined("APP_DIR")) {
    die('APP_DIR not defined!');
}
if (! defined("LIB_DIR")) {
    die('LIB_DIR not defined!');
}

require_once(dirname(LIB_DIR) . DIRECTORY_SEPARATOR . 'vendor/autoload.php');
require_once(LIB_DIR . 'handler/main.php');

use Learning\Db;
use ClanCats\Hydrahon\{Builder, BaseQuery};
use ClanCats\Hydrahon\Query\{Sql, Expression};
use ClanCats\Hydrahon\Query\Sql\{Select, Exists, Func};

/**
 * This App class is a class for action and other common function.
 * Main singleton application class. This class can be accessed anywhere with 
 * the call to App::getInstance() method
 */
class App
{
    /**
     * Constants for Logging Type
     */
    const INFO = "INFO";
    const DEBUG = "DEBUG";
    const ERROR = "ERROR";

    private static $instance = [];

    protected $fileHandle;

    protected $dbHandle;

    private $page = '';

    private $aot = '';

    protected function __construct()
    {
        $this->page = $_REQUEST['page'];
        $this->aot = $_REQUEST['aot'];
    }

    protected function __clone()
    {

    }

    public function __wakeup() 
    {
        throw new \Exception("Cannot unserialize singleton", 1);
    }

    /**
     * This method is to get lib folder path
     *
     * @return string
     */
    public function getLibPath() : string
    {
        return LIB_DIR;
    }

    /**
     * THis method is to get app folder path
     *
     * @return string
     */
    public function getAppPath() : string
    {
        return APP_DIR;
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
     * This method is to initialize database connection
     *
     * @return mixed
     */
    public function initSystemDB() : mixed
    {
        try {
            $this->dbHandle = new Db('mysql', 'localhost', 'root', '', 'learning');
            if (null == $this->dbHandle) {
                throw new \Exception("mysql://root@localhost/learning error connection", 1);            
            }
        } catch (\PDOException $e) {
            $this->writeLog('Error Connecting to DB - mysql://root@localhost/learning', $this::ERROR);
            throw new \Exception("Error connecting to database mysql://root@localhost/learning" . __FILE__ . __METHOD__ . __LINE__, 1);
        }
        return true;
    }

    /**
     * This method is to get database handler where have connected to database
     *
     * @return void
     */
    public function getDBHandle() : object | string
    {
        return $this->dbHandle;
    }

    /**
     * This method is to set the system timezone 
     *
     * @param string $timezone Predefined timezone form 
     * https://www.php.net/manual/en/timezones.php
     * 
     * @return mixed
     */
    public function setTimeZone(string $timezone) : mixed
    {
        if ((! $timezone instanceof \DateTimeZone) && 0 <= strlen($timezone)) {
            $timezone = str_replace(' ', '_', $timezone);
            if (0 == strlen($timezone)) {
                $timezone = date_default_timezone_get();
            }
            try {
                $timezone = new \DateTimeZone($timezone);
            } catch (\Exception $e) {
                $this->writeLog('There is an error in timezone value"' . $timezone . '" - ' . $e->getMessage(), $this::ERROR);
                return false;
            }
        }
        if ($timezone instanceof \DateTimeZone) {
            date_default_timezone_set($timezone->getName());
            $this->writeLog('Timezone now set to ' . $timezone->getName(), $this::INFO);
            return true;
        }
        $this->writeLog('Failed setting timezone for ' . $timezone, $this::ERROR);
        return false;
    }

    /**
     * This method is to convert UTC datetime to Asia Kuala Lumpur datetime
     *
     * @param string $datetime Value to be converted
     * 
     * @return mixed
     */
    public function dateTimeConvertToAsiaKL(string $datetime) : mixed
    {
        $date = new \DateTime($datetime);
        $date->setTimezone(new \DateTimeZone('Asia/Kuala_Lumpur'));
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * This method used Hydrahon to create new sql query builder and get the table and other column 
     * of data in database 
     * 
     * https://github.com/ClanCats/Hydrahon
     *
     * @return mixed
     */
    protected function queryBuilder() : mixed
    {
        $dbConnection = new Db ('mysql', 'localhost', 'root', '', 'learning');

        $build = new Builder (
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
        return $this->queryBuilder()->table($table);
    }

    /**
     * Initialize Log file 
     *
     * @return void
     */
    protected function initLog() : void
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
        $page = $this->page;
        $aot = $this->aot;
        $params = $_REQUEST;
        $handle = new handler\MainHandler($page);
        return $handle->getList($page, $aot, $params);
    }
}

?>