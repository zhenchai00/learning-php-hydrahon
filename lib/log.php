<?php
namespace Learning;

require_once('app.php');

use Learning\App;

/**
 * The Logging class is to Log the status of the app running 
 */
class Logging extends App
{
    /**
     * String contain the name of the log file
     *
     * @var string
     * @access protected
     */
    protected $fileHandle;

    const INFO = "INFO";
    const DEBUG = "DEBUG";
    const ERROR = "ERROR";

    /**
     * This writeFile method is to write the log file with the writeFile() function
     *
     * @param string $text message that will wrote in log file
     * @return mixed
     */
    protected function __construct ()
    {
        $this->fileHandle  = fopen( __DIR__ . '/../myapp.log', 'a+');
    }

    public function writeLog (string $text, string $alert)
    {
        $date = date('Y-m-d H:i:s');
        fwrite($this->fileHandle, ("[" . $date . "] - [" . $alert . "] - " . $text . "\r\n"));
        fclose($this->fileHandle);
    }

    public static function log(string $text) : void
    {
        $logger = static::getInstance();
        $logger->writeLog($text);
    }
    
}
?>