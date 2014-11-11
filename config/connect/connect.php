<?php

/* CREDENTIALS */
$config = array(
  'host'		=> 'andreihorodinca.dk',
  'username'	=> 'andreiho',
  'password'	=> '776T8dSuqo',
  'dbname' 	=> 'andreiho_xmldb'
);

/* CONNECTION */
try {
  $db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);
}
catch(PDOException $e)
{
  echo $e->getMessage();
}

/* ERROR MODE */
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);