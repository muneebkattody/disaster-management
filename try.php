<?php
function devider(...$vars)
{
    $s = $vars[0];
    array_shift($vars);
    $sum = 0;
    $ret_val = [];
    foreach ($vars as $n) {
        $sum += $n;
    }
    foreach ($vars as $n) {
        $v = ($n * 100) / $sum;
        $v = intval(($s * $v) / 100);
        array_push($ret_val, $v);
    }
    // Finding remaining resource
    $sum = 0;
    foreach ($ret_val as $n) {
        $sum += $n;
    }
    $rem = $s - $sum;
    $rem = "rem = " . $rem;
    array_push($ret_val, $rem);

    return $ret_val;
}

$res = devider(10, 6, 7, 2);
foreach ($res as $n) {
    echo $n . ", ";
}


function dist_calc($org,$des){
$map_api = "AIzaSyCq0CbuB7TRdaQnGmkuSUOm6Nol_X_O5Og";
$url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins='.$org.'&destinations='.$des.'&key='.$map_api;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); //Url together with parameters
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 7); //Timeout after 7 seconds
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
curl_setopt($ch, CURLOPT_HEADER, 0);

$result = curl_exec($ch);
$result = json_decode($result);

if (curl_errno($ch)) //catch if curl error exists and show it
{
    echo 'Curl error: ' . curl_error($ch);
} else {
    $elements = $result->rows[0]->elements;
    $map['distance'] = $elements[0]->distance->text;
    $map['duration'] = $elements[0]->duration->text;
}
curl_close($ch);
return $map;
}

$map = dist_calc("vadakara,calicut,IN","perambra,calicut,IN");
print_r($map);



?>