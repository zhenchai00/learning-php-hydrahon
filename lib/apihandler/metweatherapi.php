<?php

namespace Learning\apihandler;

use Learning\App;


class METWeatherAPI
{
    protected $app;
    private $token = '877b8d75811641e4043174d66d20957726394ec7';
    private $dataUrl = 'https://api.met.gov.my/v2.1/data';
    private $dataTypesUrl = 'https://api.met.gov.my/v2.1/datatypes';
    private $locationsUrl = 'https://api.met.gov.my/v2.1/locations';
    
    public function __construct()
    {
        $this->app = App::getInstance();
    }
    
    public function callMETDataTypes()
    {
        $this->app->writeLog("Connection Started - Get MET Data Types", $this->app::DEBUG);
        $curl = curl_init();
        // if ($data) $url = sprintf("%s?%s", $url, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, $this->dataTypesUrl);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: METToken ' . $this->token,
            'Cache-Control: max-age=600',
            'Content-Type: application/json'
        ]); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        if (!$result){
            $this->app->writeLog("Connection Failure to MET", $this->app::ERROR);
            return "Connection Failure";
        } elseif ($result) {
            $this->app->writeLog("Connection Successful to MET", $this->app::INFO);
        }
        curl_close($curl);
        $this->app->writeLog("Connection End - Get MET Data Types", $this->app::DEBUG);
        return $result;
    }

    public function callMETLocations()
    {

    }

    public function callMETForecast()
    {
        //
    }
}

require_once('../../app/brain.php');
$met = new \Learning\apihandler\METWeatherAPI();
$data = $met->callMETDataTypes();
print_r($data);

// $token = '877b8d75811641e4043174d66d20957726394ec7';
// $data = [
//     "datasetid" => "FORECAST",
//     "datacategoryid" => "GENERAL",
//     "locationid" => "LOCATION:112",
//     "start_date" => date("Y-m-d"),
//     "end_date" => date("Y-m-d"),
//     "lang" => "en",
// ];

// $curl = curl_init();
// curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/94.0");
// curl_setopt($curl, CURLOPT_URL, "https://api.met.gov.my/v2.1/data?" . http_build_query($data));
// curl_setopt($curl, CURLOPT_HTTPHEADER, array(
//     'Authorization: METToken ' . $token,
//     'Cache-Control: max-age=600',
//     'Content-Type: application/json'
// ));
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// $output = curl_exec($curl);
// curl_close($curl);
// echo "<pre>";
// print_r(json_decode($output));
// print_r($output);

// function callAPI($method, $url, $data){
//     $curl = curl_init();
//     switch ($method) {
//         case "POST":
//             curl_setopt($curl, CURLOPT_POST, 1);
//             if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//             break;
//         case "PUT":
//             curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
//             if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
//             break;
//         default:
//             if ($data) $url = sprintf("%s?%s", $url, http_build_query($data));
//     }
//     // OPTIONS:
//     curl_setopt($curl, CURLOPT_URL, $url);
//     curl_setopt($curl, CURLOPT_HTTPHEADER, array(
//         // 'APIKEY: 111111111111111111111',
//         // 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:94.0) Gecko/20100101 Firefox/94.0',
//         // 'Content-Type: application/x-www-form-urlencoded', 
//     ));
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//     // EXECUTE:
//     $result = curl_exec($curl);
//     if (!$result) die("Connection Failure");
//     curl_close($curl);
//     return $result;
// }
?>