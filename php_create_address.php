<?php
//==========================================================================
// Tritanium Labs USA LLC
//
// PURPOSE:  Create a new blockchain address for your account.
//
// The /createAddress endpoint is used to create a new address for an account.
// 
// API Parameters:
//     address:  The physical address or blockchain address.

//==========================================================================

$fields=array();
$fields['address']=urlencode("1600 E Golf Rd Rolling Meadows IL 60008");
$fields['auth_key']="31a151d30363396042c3d1977a5763b18b90cb7f95192b9f06e7824c626862c1:996048c0f3dff6d8dd8d6527e9184c9ae91005d33a92fccad4d8d2ca625a14a1";

$url = 'https://traceabilityapi.com/createAddress/';   

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

$result = curl_exec($ch);

curl_close($ch);

echo $result;

?>