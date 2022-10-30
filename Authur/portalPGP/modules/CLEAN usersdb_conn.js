// File Name – usersdb_conn.js

var mysql = require('mysql');
var usersdb_conn = mysql.createConnection({
  host: 'localhost',
  user: 'user',
  password: 'password',
  database: 'users'
});
usersdb_conn.connect(function(err) {
  if (err) throw err;
  console.log('Database is connected successfully !');
});
module.exports = usersdb_conn;
 