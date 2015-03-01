# mqtt-google-maps
Send moquitto subscription geo (lat-lon) data to google maps api and parse json results to file using simple PHP scripting.

I use OwnTracks, an open source location app that has the ability to send data to mosquitto broker.
This PHP script will poll the broker for published location data using a mosquitto_sub client to return the latest data
the broker received (lat, lon) in json.  The parsed geo data is sent to the google maps api (using cURL) to return more readable location data (street, city, state, country, etc), which is then saved to a local file.

You will need to have a functioning broker, in this example the code is using mosquitto.org's anonymous test broker- test.mosquitto.org.  For authentication and transport security, either setting up your own broker (or use of one that provides auth/TLS) will be necessary.

I'm using the latest mosquitto subscription client (version 1.4), and the script relys on cURL to
query the maps api.  For more details about MQTT or how to setup mosquitto clients & brokers see http://mosquitto.org or http://mqtt.org
