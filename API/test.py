import requests

payload = {"option": "measure", "humidity": 50, "temperature": 20, "pressure": 10, "date":"2023-01-02", "time":"10:00:05", "id_sensor":2 }
r = requests.post('http://192.168.121.223:8081/measures/post', params=payload)

print(r.url)
print(r.text)
