<?php

  // Dependencies
  require_once ROOT_DIR . "classes/DBAccess.php";

  // Check if website is running locally (localhost, 127.0.0.1, ::1)
  if (
    $_SERVER["SERVER_NAME"] === "localhost" ||
    $_SERVER["SERVER_ADDR"] === "127.0.0.1" ||
    $_SERVER["SERVER_ADDR"] === "::1"
  ) {

    // Database config - local
    $dbServer = "localhost";
    $dbDatbase = "northwind";
    $dbUsername = "root";
    $dbPassword = "";

  } else {

    // Database config - remote
    $dbServer = "localhost";
    $dbDatbase = "navy31_northwind";
    $dbUsername = "navy31_northwind";
    // $dbPassword = "c5dBiSl3?Kywx0#n";
    $dbPassword = REMOTE_DB_PASSWORD;  // Loading from secrets.php

  }

  // Create a new DBAccess instance (this is used for ALL database operations!)
  $db = new DBAccess($dbServer, $dbDatbase, $dbUsername, $dbPassword);