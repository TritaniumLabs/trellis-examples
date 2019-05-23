<?php
//==========================================================================
// Tritanium Labs USA LLC
// Simple Call using POST
// 
// This example uses the POST method and /trellisPut endpoint to store a 
// hash on the blockchain.
//
//
//==========================================================================

$url = 'https://traceabilityapi.com/trellisPut/';   

$fields=array();
$fields['auth_key']="31a151d30363396042c3d1977a5763b18b90cb7f95192b9f06e7824c626862c1:996048c0f3dff6d8dd8d6527e9184c9ae91005d33a92fccad4d8d2ca625a14a1";
$fields['hash']="27b4245994aa08e837d07421f0e18e478f622e2422bc3ce475690b16d6190ee9";
$fields['option']="Optional Data";
$fields['option2']="More Optional Data";

//-- url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//-- Initialied curl.
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//-- Execute curl.
$result = curl_exec($ch);

//--close connection
curl_close($ch);

echo $result;

?>