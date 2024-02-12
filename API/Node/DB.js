const mariadb = require('mariadb');
const config =  require('./config.js');


async function query_db(sqlQuery) {
    let conn;
    let res;

    try {
        // Create a new connection
        conn = await mariadb.createConnection(
            config.BDD_INFOS
        );

        res = await conn.query(sqlQuery);

    } catch (err) {
        // Print error
        console.log(err);
    } finally {
        // Close connection
        if (conn) conn.end();
    }

    return res;
}



function get_measures() {
    let query = "SELECT * FROM measures";
    let res =  Promise.resolve(query_db(query));

    return res;
}


const res =  get_measures();
console.log(res);
