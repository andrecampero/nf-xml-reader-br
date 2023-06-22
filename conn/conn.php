<?php
global $conn;

//Db
function conn_db()
{
  try
  {
	//DB
	$conn = new PDO("mysql:host=".$GLOBALS['db_host'].";dbname=".$GLOBALS['db_name'], $GLOBALS['db_user'], $GLOBALS['db_pass']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES 'utf8'");
    $conn->exec("SET CHARACTER SET 'utf8'");
    $conn->exec("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
	//$conn->exec("SET @@global.time_zone = '-3:00''");

	return $conn;
  }
  catch(PDOException $e)
  {
    $conn = null;
    return $conn;
    echo 'ERROR: ' . $e->getMessage();
  }
}
$conn = conn_db();
?>