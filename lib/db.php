<?php
Namespace Learning;

/* define('ROOT_DIR', dirname(__DIR__));
echo ROOT_DIR; die; */
include(__DIR__ . '/../vendor/autoload.php');

class Db extends \PDO
{
    /**
    * Constructor function
    *
    */
    public function __construct($type, $host, $username, $password, $database, $defaultCharset = 'utf8')
    {
        try {
            // list($host, $port) = explode(':', $host);
            parent::__construct("$type:host=$host;dbname=$database", $username, $password);
            $app = App::getInstance();
            if (null != $app) {
                $app->writeLog("Db::connect() - Connected to $host ($database)", $app::DEBUG);
            }
            if ('utf-8' == $defaultCharset) {
                $defaultCharset = 'utf8';
            }
            $defaultCharset = preg_replace('/[^-a-z0-9_]/i', '', $defaultCharset);
            if (0 < strlen($defaultCharset)) {
                $app->writeLog('Setting database charset to "' . $defaultCharset . '"...', $app::DEBUG);
                // $this->pdoDBHandle->exec('SET NAMES '.$defaultCharset);
            }
        } catch (\PDOException $e) {
            throw new \PDOException("Error Processing Request. Db not connected", 1);
            die();
        }
        return $this;
    }

    public function close()
    {
        $this->pdoDBHandle = null;
    }
}
?>
