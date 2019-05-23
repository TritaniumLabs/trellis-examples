<?php
//==========================================================================
/* Tritanium Labs USA LLC

Simple Call using curl with the GET method and /trellisHistory endpoint.

This example is equivalent to using your browser to navigate to:

https://traceabilityapi.com/trellisHistory/?auth_key=31a151d30363396042c3d1977a5763b18b90cb7f95192b9f06e7824c626862c1:996048c0f3dff6d8dd8d6527e9184c9ae91005d33a92fccad4d8d2ca625a14a1&hash=27b4245994aa08e837d07421f0e18e478f622e2422bc3ce475690b16d6190ee9

*/
//==========================================================================

$hash="27b4245994aa08e837d07421f0e18e478f622e2422bc3ce475690b16d6190ee9";
$auth_key="31a151d30363396042c3d1977a5763b18b90cb7f95192b9f06e7824c626862c1:996048c0f3dff6d8dd8d6527e9184c9ae91005d33a92fccad4d8d2ca625a14a1";

$url = 'https://traceabilityapi.com/trellisPut/?auth_key=' . $auth_key . '&hash=' . $hash;   

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, urlencode($url));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec($ch);
curl_close($ch);
echo $result;

?>