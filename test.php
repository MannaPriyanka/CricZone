<?php

$url = "https://cricapi.com/api/matchCalendar?apikey=3dLnjyswyINT65QW3jl8fgEyoaS2";
$result = file_get_contents($url);
$result = json_decode($result, true);
echo  "<pre>";
print_r($result);
?>