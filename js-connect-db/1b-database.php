<?php
/* (A) SETTINGS */
// ! CHANGE THESE TO YOUR OWN !
error_reporting(E_ALL & ~E_NOTICE);
define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

/* (B) CONNECT DATABASE */
try {
  $_PDO = new PDO(
    "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME, 
    DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_PERSISTENT => true
    ]
  );
}
catch (Exception $ex) {
  if (LOG_KEEP) { addlog($ex->getMessage()); }
  die("Error connecting to the database");
}

/* (C) HANDLE REQUESTS */
if ($_POST['req']) { switch ($_POST['req']) {
  case "get":
    $_STMT = $_PDO->prepare("SELECT * FROM `users`");
    $_STMT->execute();
    $users = $_STMT->fetchAll();
    echo json_encode($users);
    break;

  case "add":
    $pass = true;
    $error = "";
    try {
      $_STMT = $_PDO->prepare("INSERT INTO `users` (`user_name`) VALUES (?)");
      $_STMT->execute([$_POST['name']]);
      // $lastID = $_PDO->lastInsertID();
    } catch (Exception $ex) {
      $pass = false;
      $error = $ex->getMessage();
    }
    echo json_encode([
      "status" => $pass,
      "message" => $error
    ]);
    break;
}}

/* (D) CLOSE DATABASE CONNECTION */
$_PDO = null;
$_STMT = null;
?>