// (1) LOAD DB MODULE
const mysql = require("mysql");

// (2) CREATE CONNECTION
// ! CHANGE THESE TO YOUR OWN !
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'test'
});
db.connect((err) => {
  if (err) { throw err; }
  console.log("DB connection OK");
});

// (3) QUERY
db.query("SELECT * FROM `users`", function (err, results) {
  if (err) { throw err; }
  console.log(results);
});