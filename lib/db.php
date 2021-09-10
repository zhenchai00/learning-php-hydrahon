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
                
            }
            if ('utf-8' == $defaultCharset) {
                $defaultCharset = 'utf8';
            }
            $defaultCharset = preg_replace('/[^-a-z0-9_]/i', '', $defaultCharset);
            if (0 < strlen($defaultCharset)) {
                // $app->log('Setting database charset to "'.$defaultCharset.'"...', SNAP_LOG_DEBUG);
                // $this->pdoDBHandle->exec('SET NAMES '.$defaultCharset);
            }
            // echo '<br> Db Connected <br>';
        } catch (\PDOException $e) {
            throw new \PDOException("Error Processing Request. Db not connected", 1);
            die();
        }
        return $this;
    }
}
?>
