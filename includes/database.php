<?php

  // Dependencies
  require_once ROOT_DIR . "classes/DBAccess.php";

  // TODO: Check if website is running locally (localhost, 127.0.0.1, ::1)

  // Database config
  $dbServer = "localhost";
  $dbDatbase = "northwind";
  $dbUsername = "root";
  $dbPassword = "";

  // Create a new DBAccess instance (this is used for ALL database operations!)
  $db = new DBAccess($dbServer, $dbDatbase, $dbUsername, $dbPassword);