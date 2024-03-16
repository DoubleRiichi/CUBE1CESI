#!/usr/bin/env python
# encoding: utf-8
import json



from flask import Flask, request
from flask_cors import CORS
import src.db.db as Database
import src.classes.measures as table
import src.classes.sensor as s
import datetime




app = Flask(__name__)
CORS(app)




@app.route('/measures/get/all', methods=['GET'])
def measures():
    args = request.args

    sensor = args.get("sensor")

    if sensor:
        res = Database.general_query(f"SELECT * FROM `{table.Measures.TABLENAME}` WHERE `{table.Measures.COL_SENSOR}` = {sensor};")
    else:
        res = Database.get_every_entries("*", table.Measures.TABLENAME)

    return res


@app.route('/measures/get/by_date', methods=['GET'])
def measures_by_date():
    args = request.args

    date = args.get("date")
    sensor = args.get("sensor")

    if not date:
        return json.dumps({"error": 404})

    if sensor:

        res = Database.general_query(f"SELECT * FROM `{table.Measures.TABLENAME}` WHERE `{table.Measures.COL_DATE}` = '{date}' AND `{table.Measures.COL_SENSOR}` = {sensor}")
    else:
        res = Database.general_query(f"SELECT * FROM `{table.Measures.TABLENAME}` WHERE `{table.Measures.COL_DATE}` = '{date}'")

    return res


@app.route('/measures/get/last', methods=['GET'])
def measures_last():
    args = request.args

    sensor = args.get("sensor")
    n = args.get("n")
    query = f"SELECT * FROM {table.Measures.TABLENAME} "

    if sensor:
        query += f"WHERE `{table.Measures.COL_SENSOR}` = {sensor}"

    if n:
        query += f"ORDER BY `{table.Measures.COL_DATE}` DESC LIMIT {n}"
    else:
        query += f"ORDER BY `{table.Measures.COL_DATE}` DESC LIMIT 1"

    query += ";"
    res = Database.general_query(query)

    if not res:
        return json.dumps({"error": 404})

    return res


@app.route('/measures/get/between_hours', methods=['GET'])
def measures_between_time():
    args = request.args

    date = args.get("date")
    begin = args.get("begin")
    end = args.get("end")
    sensor = args.get("sensor")

    if not (date and begin and end):
        return json.dumps({"error": 404})

    query = f"SELECT * FROM `{table.Measures.TABLENAME}` WHERE ("

    if sensor:
        query += f"`{table.Measures.COL_SENSOR}` = {sensor} AND "
    if date and begin and end:
        query += f"`{table.Measures.COL_DATE}` = '{date}' AND `{table.Measures.COL_TIME}` BETWEEN '{begin}' AND '{end}'"

    query += ");"

    return Database.general_query(query)


@app.route("/measures/insert", methods=['POST'])
def insert_measures():
    json_input = request.get_json()

    temperature = json_input.get('temperature')
    humidity = json_input.get("humidity")
    pressure = json_input.get("pressure")
    dt = datetime.datetime.now()
    date = dt.strftime("%Y-%m-%d")
    time = dt.strftime("%H:%M:%S")
    sensor = json_input.get("sensor")

    if not (temperature and humidity and pressure and date and sensor):
        return json.dumps("404")

    res = Database.general_query(f"INSERT INTO `{table.Measures.TABLENAME}` VALUES (0, {temperature}, {humidity}, {pressure}, '{date}', {sensor}, '{time}')")

    if not res:
        return json.dumps("ERROR")

    return res


@app.route('/flask-health-check')
def flask_health_check():
    return "success"


@app.route("/sensor/insert", methods=['POST'])
def insert_sensor():
    json_input = request.get_json()
    boot_date = json_input.get('date')
    boot_time = json_input.get('time')
    location = json_input.get('location')
    measures_count = 0

    if not (boot_date and boot_time):
        return json.dumps({"error": 404})

    res = Database.general_query(f"INSERT INTO `{s.Sensor.TABLENAME}` VALUE (0, '{boot_date}', '{boot_time}', '{location}', {measures_count})")

    if not res:
        return json.dumps({"error": "undefined"})

    return res


@app.route("/sensor/update/<int:sensor_id>", methods=['PUT'])
def update_sensor(sensor_id):

    if not sensor_id:
        return json.dumps({"error": 400})

    json_input = request.get_json()

    boot_date = json_input.get('date')
    boot_time = json_input.get('time')
    location = json_input.get('location')
    measures_count = json_input.get('count')

    query = f"UPDATE {s.Sensor.TABLENAME} SET "
    count = 0

    if boot_date:
        query += f"{s.Sensor.BOOT_DATE} = '{boot_date}'"
        count += 1
    if boot_time:
        if count > 0:
            query += ", "

        query += f"{s.Sensor.BOOT_TIME} = '{boot_time}'"
    if location:
        if count > 0:
            query += ", "

        query += f"{s.Sensor.LOCATION} = '{location}'"

    if measures_count:
        if count > 0:
            query += ", "
        query += f"{s.Sensor.MEASURES} = {measures}"

    query += f" WHERE {s.Sensor.ID} = {sensor_id}"
    print(query)

    res = Database.general_query(query)
    if not res:
        return json.dumps({"error": 404})

    return res


@app.route("/sensor/get/<int:sensor_id>", methods=['GET'])
def get_sensor(sensor_id):

    if not sensor_id:
        return json.dumps({"error": 400})

    query = f"SELECT * FROM {s.Sensor.TABLENAME} WHERE {s.Sensor.ID} = {sensor_id}"

    res = Database.general_query(query)

    if not res:
        return json.dumps({"error": 404})

    return res


@app.route("/sensor/get/all", methods=["GET"])
def get_all_sensor():

    query = f"SELECT * FROM {s.Sensor.TABLENAME}"

    res = Database.general_query(query)

    if not res:
        return  json.dumps({"error": 404})

    return  res


@app.route("/sensor/delete/<int:sensor_id>", methods=['DELETE'])
def delete_sensor(sensor_id):

    if not sensor_id:
        return json.dumps({"error": 400})

    query = f"DELETE FROM {s.Sensor.TABLENAME} WHERE {s.Sensor.ID} = {sensor_id}"

    res = Database.general_query(query)

    return res

