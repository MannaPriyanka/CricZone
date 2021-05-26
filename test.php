<?php
require_once 'config.php';
$url = "https://cricapi.com/api/playerFinder?apikey=" . $API_KEY . "&name=VIRAT";
$result = file_get_contents($url);
$result = json_decode($result, true);
echo  "<pre>";
if($result["data"]["fullname"] == "VIRAT"){
echo "find";
}
print_r($result);

?>