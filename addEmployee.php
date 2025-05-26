<?php

  // Common includes for main PHP pages (controllers)
  require_once "includes/common.php";

  // Config
  $title = "Add staff member";

  // Start output buffering
  ob_start();

  // Check if form has been submitted
  if (isset($_POST["submitAddEmployee"])) {

    // Collection of all errors for this submission
    $errors = [];
    
    // Get data passed to this page
    $titleOfCourtesy = $_POST["title"] ?? "";
    $firstName = $_POST["firstName"] ?? "";
    $lastName = $_POST["lastName"] ?? "";
    $birthDate = $_POST["dateOfBirth"] ?? "";
    $hireDate = $_POST["hireDate"] ?? "";
    $position = $_POST["position"] ?? "";
    $salary = $_POST["salary"] ?? null;
    $reportsTo = $_POST["reportsTo"] ?? null;
    $notes = $_POST["notes"] ?? "";

    // TODO: Handle the image upload?!
    $photoPath = "abc.jpg";

    // Normalise/sanitize data
    $titleOfCourtesy = trim($titleOfCourtesy);
    $firstName = trim($firstName);
    $lastName = trim($lastName);
    $position = trim($position);
    $notes = trim($notes);

    // Validate first name
    if ($firstName === "") {
      $errors["firstName"] = "First name is required";
    } else if (strlen($firstName) < 2 || strlen($firstName) > 10) {
      $errors["firstName"] = "First name must be 2-10 characters";
    }

    // Validate last name
    if ($lastName === "") {
      $errors["lastName"] = "Last name is required";
    } else if (strlen($lastName) < 2 || strlen($lastName) > 20) {
      $errors["lastName"] = "Last name must be 2-20 characters";
    }

    // TODO: Validate DateOfBirth (valid date)

    // TODO: Validate HireDate (valid date)

    // TODO: Validate Salary (valid float)

    // TODO: Validate ReportsTo (valid employee ID)


    // Check if we have errors (invalid data)
    if (count($errors) > 0) {

      // Invalid - redisplay the form with errors
      include_once TEMPLATES_DIR . "_addEmployeePage.html.php";
      
    } else {

      // Valid - add the employee to the database

      // TODO: Define SQL query
      $sql = <<<SQL
        INSERT INTO employees (LastName, FirstName, Title, TitleOfCourtesy, BirthDate, HireDate, Notes, ReportsTo, PhotoPath, Salary)
        VALUES (:LastName, :FirstName, :Title, :TitleOfCourtesy, :BirthDate, :HireDate, :Notes, :ReportsTo, :PhotoPath, :Salary)
      SQL;

      // Prepare the statement
      $stmt = $db->prepareStatement($sql);

      // Bind values (if needed)
      $stmt->bindValue(":LastName", $lastName, PDO::PARAM_STR);
      $stmt->bindValue(":FirstName", $firstName, PDO::PARAM_STR);
      $stmt->bindValue(":Title", $position, PDO::PARAM_STR);
      $stmt->bindValue(":TitleOfCourtesy", $titleOfCourtesy, PDO::PARAM_STR);
      $stmt->bindValue(":BirthDate", $birthDate, PDO::PARAM_STR);
      $stmt->bindValue(":HireDate", $hireDate, PDO::PARAM_STR);
      $stmt->bindValue(":Notes", $notes, PDO::PARAM_STR);
      $stmt->bindValue(":ReportsTo", $reportsTo, PDO::PARAM_INT);
      $stmt->bindValue(":PhotoPath", $photoPath, PDO::PARAM_STR);
      $stmt->bindValue(":Salary", $salary, PDO::PARAM_STR);
      
      // Insert the employee
      // We're passing "true" in order to get the new ID (primary key) back to us
      $newEmployeeId = $db->executeNonQuery($stmt, true);

      // Display success message
      $successMessage = "Employee added successfully, new ID: $newEmployeeId";
      include_once TEMPLATES_DIR . "_success.html.php";

    }

  } else {

    // Just display the empty form
    include_once TEMPLATES_DIR . "_addEmployeePage.html.php";

  }

  // Stop output buffering
  $content = ob_get_clean();

  // Include the main layout template
  include_once TEMPLATES_DIR . "_layout.html.php";