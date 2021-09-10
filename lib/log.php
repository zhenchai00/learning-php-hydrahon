<?php
namespace Learning;

/**
 * The Logging class is to Log the status of the app running 
 */
class Logging 
{
    /**
     * String contain the name of the log file
     *
     * @var string
     * @access protected
     */
    protected $fileName = __DIR__ . '/../myapp.log';
    
    /**
     * String contain the date for the executed time
     *
     * @var string
     * @access protected
     */
    protected $date = '';

    /**
     * This writeFile method is to write the log file with the writeFile() function
     *
     * @param string $text message that will wrote in log file
     * @return mixed
     */
    public function __construct ($text)
    {
        $this->date = date('Y-m-d H:i:s');

        $fopen = fopen($this->fileName, "a+") ? fopen($this->fileName, "a+") : die('Unable to open file! File does not exist');
        fwrite($fopen, ("[" . $this->date . "] - " . $text . "\r\n"));
        fclose($fopen);
    }
}
?>