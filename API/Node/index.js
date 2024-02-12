const express = require("express");
const app = express();
const port = 3000;


app.get("/measures/get_all", function (req, res) {

})


app.listen(port, function () {
    console.log('Listening on port 3000');
});
