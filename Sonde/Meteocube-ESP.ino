/*
BME280 I2C Test.ino

This code shows how to record data from the BME280 environmental sensor
using I2C interface. This file is an example file, part of the Arduino
BME280 library.

GNU General Public License

Written: Dec 30 2015.
Last Updated: Oct 07 2017.

Connecting the BME280 Sensor:
Sensor              ->  Board
-----------------------------
Vin (Voltage In)    ->  3.3V
Gnd (Ground)        ->  Gnd
SDA (Serial Data)   ->  A4 on Uno/Pro-Mini, 20 on Mega2560/Due, 2 Leonardo/Pro-Micro
SCK (Serial Clock)  ->  A5 on Uno/Pro-Mini, 21 on Mega2560/Due, 3 Leonardo/Pro-Micro

 */

#include <BME280I2C.h>
#include <Wire.h>
#include <Adafruit_SSD1327.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <string>

#ifndef STASSID
#define STASSID "DanaIphone"
#define STAPSK "meteocube"
#endif

const char* ssid = STASSID;
const char* password = STAPSK;

const char* host = "localhost";
const uint16_t port = 5000;
const uint16_t SENSOR_ID = 1;

BME280I2C bme;    // Default : forced mode, standby time = 1000 ms
                  // Oversampling = pressure ×1, temperature ×1, humidity ×1, filter off,

Adafruit_SSD1327 display(128, 128, &Wire, -1, 1000000);

typedef struct measures {
  float temp;
  float humidity;
  float pressure;
} Measures;

//////////////////////////////////////////////////////////////////
void setup()
{
  Serial.begin(9600);

  while(!Serial) {} // Wait

  Wire.begin(0, 2);

  if ( ! display.begin(0x3D) ) {
    Serial.println("Unable to initialize OLED");
    while (1) yield();
  }
  display.clearDisplay();
  display.display();

  while(!bme.begin())
  {
    Serial.println("Could not find BME280 sensor!");
    delay(1000);
  }

  switch(bme.chipModel())
  {
    case BME280::ChipModel_BME280:
      Serial.println("Found BME280 sensor! Success.");
      break;
    case BME280::ChipModel_BMP280:
      Serial.println("Found BMP280 sensor! No Humidity available.");
      break;
    default:
      Serial.println("Found UNKNOWN sensor! Error!");
  }

  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }



  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

//////////////////////////////////////////////////////////////////
void loop()
{
    Measures current;
    current = printBME280Data(&Serial);

    WiFiClient client;
    HTTPClient http;
    Serial.print("passed");
    Serial.print("[HTTP] begin...\n");
    // configure traged server and url
    http.begin(client, "http://172.20.10.2:5000/measures/insert");
    //http.addHeader("Content-Type", "application/json");
    http.addHeader("Content-Type", "application/json");
    Serial.print("[HTTP] POST...\n");
    // start connection and send HTTP header and body

    String json_query = "{\"temperature\": " + String((int) current.temp) + ", \"pressure\": " + String((int) current.humidity) + ", \"humidity\": " + String((int) current.humidity) + ", \"sensor\": " + String(SENSOR_ID) + "}";
    Serial.print(json_query);

    //int httpCode = http.POST(json_query);
    int httpCode = http.POST(json_query);

    // httpCode will be negative on error
    if (httpCode > 0) {
      // HTTP header has been send and Server response header has been handled
      Serial.printf("[HTTP] POST... code: %d\n", httpCode);

      // file found at server
      if (httpCode == HTTP_CODE_OK) {
        const String& payload = http.getString();
        Serial.println("received payload:\n<<");
        Serial.println(payload);
        Serial.println(">>");
      }
    } else {
      Serial.printf("[HTTP] POST... failed, error: %s\n", http.errorToString(httpCode).c_str());
    }

    http.end();

  delay(10000);
}

//////////////////////////////////////////////////////////////////
Measures printBME280Data(Stream* client)
{
  float temp(NAN), hum(NAN), pres(NAN);
  Measures current;

  BME280::TempUnit tempUnit(BME280::TempUnit_Celsius);
  BME280::PresUnit presUnit(BME280::PresUnit_hPa);

  bme.read(pres, temp, hum, tempUnit, presUnit);

  //Serial Monitor Part

  client->print("Temp: ");
  client->print(temp);
  client->print("°"+ String(tempUnit == BME280::TempUnit_Celsius ? 'C' :'F'));
  client->print("\t\tHumidity: ");
  client->print(hum);
  client->print("% RH");
  client->print("\t\tPressure: ");
  client->print(pres);
  client->println("hPa");

  //Display Part

  display.clearDisplay();
  display.setCursor(0,0);

  display.print("\n");
  display.print("Temp: ");
  display.print(temp);
  display.print("\t"+ String(tempUnit == BME280::TempUnit_Celsius ? 'C' :'F'));
  display.print("\n");

  display.print("Humidity: ");
  display.print(hum);
  display.print("% RH");
  display.print("\n");

  display.print("Pressure: ");
  display.print(pres);
  display.println("hPa");

  display.display();

  current.temp = temp;
  current.pressure = pres;
  current.humidity = hum;

  return current;
}
