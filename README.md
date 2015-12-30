# mqtt-google-maps
Purpose:  Setup client device(s) to report location data using the MQTT protocol in lat-lon to a server which will them retrieve the 'city, state, country' data from the google-maps api.  This is useful if you want to post periodic city precision level tracking to a website or service.

Owntracks is an awesome open source smartphone location app which is installed on the client phone in order to send data to a MQTT broker.
The PHP script will kick off a request to a locally installed mosquitto_sub client to return the latest data
the broker received (lat, lon) in json.  The script will parse the geo data and format a request to the google maps api (using cURL) in order to return readable location data (street, city, state, country, etc), which is then saved to a local file or could be sent to a database or service.

Requirements:  You will need to have a functioning MQTT broker, in this example the code uses mosquitto.org's anonymous test broker- test.mosquitto.org.  For authentication and transport security, setting up your own broker (or use of one that provides auth/TLS) will be necessary.  A MQTT client is also required to poll the broker (I use the mosquitto_sub client).

This was setup using the latest mosquitto subscription client at the time (version 1.4), which has a switch to return only the latest data.  cURL must be installed for the script to query the maps api.  To download and setup a Mosquitto client & broker see http://mosquitto.org  And for more information about the MQTT protocol, visit http://mqtt.org
