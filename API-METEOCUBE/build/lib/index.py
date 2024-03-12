#!/usr/bin/env python
# encoding: utf-8
from flask import Flask, request
import src.db.db as Database
import src.classes.measures as table

app = Flask(__name__)

@app.route('/measures/all', methods=['GET'])
def measures():
    args = request.args

    sensor = args.get("sensor")

    if sensor:
        res = Database.get_entries_options("*", table.Measures.TABLENAME, f"sensor = {sensor}")
    else:
        res = Database.get_every_entries("*", table.Measures.TABLENAME)

    return res


@app.route('/measures/by_date', methods=['GET'])
def measures_by_date():
    args = request.args

    date = args.get("date")
    sensor = args.get("sensor")

    if not date:
        return "404"

    if sensor:
        where = f"{table.Measures.COL_DATE} = '{date}' AND {table.Measures.COL_SENSOR} = {sensor}"
        res = Database.get_entries_options("*", table.Measures.TABLENAME, where)
    else:
        res = Database.get_entries_options("*", table.Measures.TABLENAME, f"{table.Measures.COL_DATE} = '{date}'")

    return res


@app.route('/measures/last', methods=['GET'])
def measures_last():
    args = request.args

    sensor = args.get("sensor")

    if sensor:
        where = f"{table.Measures.COL_SENSOR} = {sensor}"
        res = Database.get_entries_options("*", table.Measures.TABLENAME, where=where, col_order=table.Measures.COL_DATE, order="DESC", limit=1)
    else:
        res = Database.get_entries_options("*", table.Measures.TABLENAME,  col_order=table.Measures.COL_DATE, order="DESC", limit=1)

    return res


@app.route('/measures/between_hours', methods=['GET'])
def measures_between_time():
    args = request.args

    date = args.get("date")
    begin = args.get("begin")
    end = args.get("end")
    sensor = args.get("sensor")

    if not date or not begin or not end:
        return "404"

    where = f"{table.Measures.COL_DATE} = {date} AND {table.Measures.COL_TIME} BETWEEN '{begin}' AND '{end}'"

    if sensor:
        where += f" AND {table.Measures.COL_SENSOR} = {sensor}"

    return Database.get_entries_options("*", table.Measures.TABLENAME, where, table.Measures.COL_TIME, "DESC")


#@app.route("/measures/insert", methods=['POST'])
#def insert_measures():

