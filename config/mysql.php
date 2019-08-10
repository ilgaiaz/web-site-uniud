<?php
# This function reads your DATABASE_URL configuration automatically set by Heroku
# the return value is a string that will work with pg_connect
function pg_connection_string() {
  return "dbname=abcdefg host=heroku_1c6bc9375739b50 port=5432 user=b6df9263765a9a password=13c81934 sslmode=require";
}
 
# Establish db connection
$conn = pg_connect(pg_connection_string());
if (!$conn) {
    echo "Database connection error."
    exit;
}
 
$result = pg_query($conn, "SELECT statement goes here");
?>
