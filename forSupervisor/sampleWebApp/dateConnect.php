<?php
  define('DB_HOST', 'localhost');
  define('DB_USER', 'admin');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'guitar');
  $database_connect = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
  $connect = mysql_select_db(DB_NAME,$database_connect);
?>
