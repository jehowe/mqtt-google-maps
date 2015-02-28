# mqtt-google-maps
Send moquitto subscription geo (lat-lon) data to google maps api and parse json results to file

I use OwnTracks, an open source location app that has the ability to send data to mosquitto broker.
This simple PHP script will poll the broker using the mosquitto_sub client to return the latest data
the broker received (lat, lon), sending it to the google maps api to return more readable location data - street, city, state, country, etc....

I'm using the latest mosquitto subscription client (version 1.4), and the script relys on cURL to
query the maps api. 
