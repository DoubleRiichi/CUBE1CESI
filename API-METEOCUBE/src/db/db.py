import mysql.connector
import json
import mariadb

class _DB:
    user = "jimmy"
    password = "root"
    database = "meteocube"
    host = "localhost"

    @staticmethod
    def connect_db():
        try:
            #cnx = mysql.connector.connect(user=_DB.user, password=_DB.password, host=_DB.host, database=_DB.database)
            cnx = mariadb.connect(user=_DB.user, password=_DB.password, host=_DB.host, database=_DB.database, port=3306)
        #except mysql.connector.Error as err:
        except mariadb.Error as err:
            print(err)
            return None
        else:
            return cnx


def general_query(query):
    cnx = _DB.connect_db()

    if cnx is None:
        return "500"  # 500 = INTERNAL SERVER ERROR

    cursor = cnx.cursor(dictionary=True)

    cursor.execute(query)
    try:
        res = cursor.fetchall()
    except mariadb.Error as err:
        res = -1

    cursor.close()
    cnx.close()

    if res:
        return json.dumps(res, default=str)
    else:
        return "404" # NOT FOUND


def get_every_entries(col, table):
    cnx = _DB.connect_db()

    if cnx is None:
        return "500" # 500 = INTERNAL SERVER ERROR

    cursor = cnx.cursor(dictionary=True)

    query = f"SELECT {col} FROM {table}"

    cursor.execute(query)
    res = cursor.fetchall()
    cursor.close()
    cnx.close()

    if res:
        return json.dumps(res, default=str)
    else:
        return "404" # NOT FOUND


def get_entries_options(col, table, where=None, col_order=None, order=None, limit=None):
    cnx = _DB.connect_db()

    if cnx is None:
        return "500" # 500 = INTERNAL SERVER ERROR

    cursor = cnx.cursor(dictionary=True)
    query = f"SELECT {col} FROM `{table}`"

    if where:
        query += f" WHERE {where}"
    if order and col_order:
        query += f" ORDER BY {col_order} {order}"
    if limit:
        query += f" LIMIT {limit}"
    print(query)
    cursor.execute(query )
    res = cursor.fetchall()
    cursor.close()
    cnx.close()

    if res:
        return json.dumps(res, default=str)
    else:
        return "404" # NOT FOUND





