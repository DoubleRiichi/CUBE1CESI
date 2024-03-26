#include <BME280I2C.h>
#include <Wire.h>
#include <Adafruit_SSD1327.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <string>

#ifndef STASSID
#define STASSID "meteocube"
#define STAPSK "meteocube"
#endif

const char* ssid = STASSID;
const char* password = STAPSK;

const String HOST = "172.20.10.3";
const String PORT = "5000";
const String URL = "http://" + HOST + ":" + PORT; 
const int SENSOR_ID = 1;

BME280I2C bme;    // Default : forced mode, standby time = 1000 ms
                  // Oversampling = pressure ×1, temperature ×1, humidity ×1, filter off,

Adafruit_SSD1327 display(128, 128, &Wire, -1, 1000000);

typedef struct measures {
  float temp;
  float humidity;
  float pressure;
} Measures;

//////////////////////////////////////////////////////////////////
void setup() {
  Serial.begin(9600);

  while(!Serial) {} // Wait
  Serial.println(URL);
  Wire.begin(0, 2);

  if ( ! display.begin(0x3D) ) {
    Serial.println("Unable to initialize OLED");
    while (1) yield();
  }
  display.clearDisplay();
  display.display();

  while(!bme.begin()) {
    Serial.println("Could not find BME280 sensor!");
    delay(1000);
  }

  switch(bme.chipModel()) {
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
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

//////////////////////////////////////////////////////////////////
void loop() {
  int temp_total = 0;
  int humidity_total = 0;
  int pressure_total = 0;
  int count = 0;

  while(count <= 5) {
    Measures current;
    current = printBME280Data(&Serial);

    int temperature = current.temp;
    int humidity = current.humidity;
    int pressure = current.pressure;

    if(temperature > -100 && temperature < 100 && humidity >= 0 && humidity <= 101 && pressure > 500 && pressure < 1500) {
        
      temp_total += temperature;
      humidity_total += humidity;
      pressure_total += pressure;

      delay(12000);
      count++;
    }
  }

  temp_total = temp_total / count;
  humidity_total = humidity_total / count;
  pressure_total = pressure_total / count;

  Serial.printf("Sending temp: %d hum: %d pressure: %d \n", temp_total, humidity_total, pressure_total);
  sendMeasures("/measures/insert", temp_total, humidity_total, pressure_total);
}

//////////////////////////////////////////////////////////////////
Measures printBME280Data(Stream* client) {
  float temp(NAN), hum(NAN), pres(NAN);
  Measures current;

  BME280::TempUnit tempUnit(BME280::TempUnit_Celsius);
  BME280::PresUnit presUnit(BME280::PresUnit_hPa);

  bme.read(pres, temp, hum, tempUnit, presUnit);

  //Serial Monitor Part

  client->print("Temp: ");
  client->print(temp);
  client->print(" °" + String(tempUnit == BME280::TempUnit_Celsius ? 'C' :'F'));
  client->print("\t\tHumidity: ");
  client->print(hum);
  client->print(" % RH");
  client->print("\t\tPressure: ");
  client->print(pres);
  client->println(" hPa");

  //Display Part

  display.clearDisplay();
  display.setCursor(12, 2);

  display.setTextSize(2);
  display.print("MeteoCube");

  display.print("\n");
  display.print("\n");

  display.setTextSize(1);

  display.print("Temp:     ");
  display.print(temp);
  display.println(" \t" + String(tempUnit == BME280::TempUnit_Celsius ? 'C' :'F') + "\n");

  display.print("Humidity: ");
  display.print(hum);
  display.println(" % RH \n");

  display.print("Pressure: ");
  display.print(pres);
  display.println(" hPa");

  display.setCursor(20, 118);
  display.print(WiFi.localIP());

  display.display();

  current.temp = temp;
  current.pressure = pres;
  current.humidity = hum;

  return current;
}


void sendMeasures(String endpoint, int temperature, int humidity, int pressure) {
  WiFiClient client;
  HTTPClient http;

  Serial.print("[HTTP] begin...\n");

  // configure traged server and url
  http.begin(client, URL + endpoint);

  http.addHeader("Content-Type", "application/json");
  Serial.print("[HTTP] POST...\n");
    
  // start connection and send HTTP header and body

  String json_query = "{\"temperature\": " + String(temperature) + ", \"pressure\": " + String(pressure) + ", \"humidity\": " + String(humidity) + ", \"sensor\": 1}";
  Serial.print(json_query);

    
  int httpCode = http.POST(json_query);

  // httpCode will be negative on error
  if (httpCode > 0) {
    // HTTP header has been send and Server response header has been handled
    Serial.printf("[HTTP] POST... code: %d\n", httpCode);

    // file found at server
    if (httpCode == HTTP_CODE_OK) {
      const String& payload = http.getString();
      Serial.print("received payload: << ");
      Serial.print(payload);
      Serial.println(" >>");
    }
  }
  else {    
    Serial.printf("[HTTP] POST... failed, error: %s\n", http.errorToString(httpCode).c_str());
  }

  http.end();  
}
