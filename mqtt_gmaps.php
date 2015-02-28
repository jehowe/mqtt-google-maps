<?php
/* feed mosquitto's lat-lon coordinate data to googlemaps api and parse json response to file
   author: Jeff Howe
*/   
   
// poll mosquitto broker for coordinate data using mosquitto_sub
// *NOTE using mosquitto_sub version 1.4 & test.mosquitto.org as the host for ease of demonstration
// you will want to use your own (or affiliate) broker to get user/password & data transport security
// *NOTE the '-C' switch (only in >= 1.4) limits the broker response to the latest result
// you will need to replace 'yourhandle' below with your client user/handle
$result = exec("mosquitto_sub -C 1 -h test.mosquitto.org -p 1883 -v -t 'owntracks/yourhandle/#'");

// trim the 'client header' from the json broker response *NOTE if you don't know the client header
// use 'var_dump($result);' to discover the exact string to trim 
$result = ltrim($result, "owntracks/yourhandle/4997fb92438a15af");

// decode brokers json response
$json = json_decode($result, true);

// parse and join 'lat' and 'lon' key values from response to var $latlng
$latlng = $json["lat"].",".$json["lon"];


// build the url to send to googlemaps api
$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . urlencode($latlng) . '&sensor=true';

// use curl ping maps api and get response
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// decode json response to $response
$response = json_decode(curl_exec($ch), true);

// check the 'status' key to make sure it's 'OK'
if ($response['status'] != 'OK') {
  echo 'An error has occured: ' . print_r($response);
} else {

// setup $location as an array and fill using switch to parse google's json response
$location = array();

// use foreach to pull out 'address_compnents' *NOTE json response will have additional parts
// that I am ignoring here.  Please edit the key:values below to fit your needs.

  foreach ($response['results'][0]['address_components'] as $component) {

    switch ($component['types']) {
      case in_array('street_number', $component['types']):
        $location['street_number'] = $component['long_name'];
        break;
      case in_array('route', $component['types']):
        $location['street'] = $component['long_name'];
        break;
      case in_array('locality', $component['types']):
        $location['locality'] = $component['long_name'];
        break;
      case in_array('administrative_area_level_2', $component['types']):
        $location['admin_2'] = $component['long_name'];
        break;
      case in_array('administrative_area_level_1', $component['types']):
        $location['admin_1'] = $component['long_name'];
        break;
      case in_array('postal_code', $component['types']):
        $location['postal_code'] = $component['long_name'];
        break;
      case in_array('country', $component['types']):
        $location['country'] = $component['long_name'];
        break;
    }

  }

}

// put key values into $locdata and write to file loc-data.txt - modify to fit your needs
$locdata = $location['street_number']." ".$location['street']." ".$location['locality']." ".$location['admin_2']." ".$location['admin_1']." ".$location['postal_code']." ".$location['country'];;
$file = fopen("loc-data.txt", "w") or die("data unavailable");
fwrite($file, $locdata);
fclose($file);

?>
