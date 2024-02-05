<?php

DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', '127.0.0.1');
DEFINE ('DB_NAME', 'db_kimson');


$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
or DIE ('Could not connect to the database: ' . mysqli_connect_error());

$pesos = "\u{20b1}";
?>