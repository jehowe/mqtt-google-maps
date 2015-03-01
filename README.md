# mqtt-google-maps
Send moquitto subscription geo (lat-lon) data to google maps api and parse json results to file using a single PHP script file.

I use OwnTracks, an open source smartphone location app that has the ability to send data to a MQTT broker.
This PHP script will kick off a request to a locally installed mosquitto_sub client to return the latest data
the broker received (lat, lon) in json.  The script will then parse the geo data and format a request to google maps api (using cURL) to return more readable location data (street, city, state, country, etc), which is then saved to a local file.

You will need to have a functioning broker, in this example the code is using mosquitto.org's anonymous test broker- test.mosquitto.org.  For authentication and transport security, either setting up your own broker (or use of one that provides auth/TLS) will be necessary.  A MQTT client is also required to poll the broker (I use the mosquitto_sub client).

I'm using the latest mosquitto subscription client (version 1.4), and the script relys on having cURL installed to
query the maps api.  To download and setup the Mosquitto client & broker see http://mosquitto.org.  And for more information about the MQTT protocol, visit http://mqtt.org.
