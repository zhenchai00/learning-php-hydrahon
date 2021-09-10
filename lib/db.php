<?php
Namespace Learning;

require(__DIR__ . '/../vendor/autoload.php');

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
            // $app = App::getInstance();
            if ('utf-8' == $defaultCharset) {
                $defaultCharset = 'utf8';
            }
            $defaultCharset = preg_replace('/[^-a-z0-9_]/i', '', $defaultCharset);
            if (0 < strlen($defaultCharset)) {
                // $app->log('Setting database charset to "'.$defaultCharset.'"...', SNAP_LOG_DEBUG);
                // $this->pdoDBHandle->exec('SET NAMES '.$defaultCharset);
            }
            // echo '<br> Db Connected <br>';
        } catch (PDOException $e) {
            // if (null != $app) {
            //     $app->log("Db::connect() - Failed connecting to $type://$username:$password@$host/$database - ".$this->pdoDBHandle->ErrorMsg(), SNAP_LOG_ERROR);
            // }
            echo '<br> Db not connected <br>';
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
