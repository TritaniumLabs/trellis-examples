<?php
//==========================================================================
// Tritanium Labs USA LLC
// Simple Call using POST
//
// This PHP example uses curl to call the trellisHistory/ endpoint using 
// the POST method.
//
//
//==========================================================================

$url = 'https://traceabilityapi.com/trellisHistory/';   

$fields=array();
$fields['auth_key']="31a151d30363396042c3d1977a5763b18b90cb7f95192b9f06e7824c626862c1:996048c0f3dff6d8dd8d6527e9184c9ae91005d33a92fccad4d8d2ca625a14a1";
$fields['hash']="27b4245994aa08e837d07421f0e18e478f622e2422bc3ce475690b16d6190ee9";

foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

$result = curl_exec($ch);

curl_close($ch);

echo $result;

?>