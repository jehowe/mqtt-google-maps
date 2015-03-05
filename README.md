# mqtt-google-maps
Use a mosquitto subscription client to poll a MQTT broker and send the geo data (lat-lon) to google-maps api and parse the json results to a file using a single PHP script file.

I use OwnTracks, an awesome open source smartphone location app that has the ability to send data to a MQTT broker.
This PHP script will kick off a request to a locally installed mosquitto_sub client to return the latest data
the broker received (lat, lon) in json.  The script parses out the geo data and formats a request to google maps api (using cURL) to return readable location data (street, city, state, country, etc), which is then saved to a local file.

Requirements:  You will need to have a functioning MQTT broker, in this example the code uses mosquitto.org's anonymous test broker- test.mosquitto.org.  For authentication and transport security, setting up your own broker (or use of one that provides auth/TLS) will be necessary.  A MQTT client is also required to poll the broker (I use the mosquitto_sub client).

I'm using the latest mosquitto subscription client (version 1.4) which has a switch to return only the latest data.  cURL must be installed for the script to query the maps api.  To download and setup a Mosquitto client & broker see http://mosquitto.org  And for more information about the MQTT protocol, visit http://mqtt.org
