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

    // Validate ReportsTo (valid integer and employee ID exists in database)
    if (filter_var($reportsTo, FILTER_VALIDATE_INT) === false) {
      $errors["reportsTo"] = "Reports To ID must be an integer";
    } else if ($reportsTo < 1) {
      $errors["reportsTo"] = "Reports To ID must be greater than zero";
    } else {

      // Check if employee exists in database
      $sql = <<<SQL
        SELECT COUNT(*)
        FROM employees
        WHERE EmployeeID = :EmployeeID
      SQL;

      // Prepare the statement
      $stmt = $db->prepareStatement($sql);

      // Bind values (if needed)
      $stmt->bindValue(":EmployeeID", $reportsTo, PDO::PARAM_INT);
      
      // Check if employee ID is in the database using COUNT(*)
      $employeeCount = $db->executeSQLReturnOneValue($stmt);

      if ($employeeCount < 1) {
        $errors["reportsTo"] = "Reports To ID doesn't exist";
      }
    }


    /* 
     * Photo file upload
     * Reference for the $_FILES array: https://www.php.net/manual/en/features.file-upload.post-method.php
     */

    // File upload settings
    $targetDirectory = ROOT_DIR . "photos/";
    $fileUploadOptional = false;

    // Skip file upload if no file given and upload is optional
    if (!($fileUploadOptional && $_FILES["photo"]["error"] === UPLOAD_ERR_NO_FILE)) {

      // Get the filename of the uploaded file (what was it originally called?)
      $fileName = basename($_FILES["photo"]["name"]);

      // Make sure file is an image (using file extension)
      $validExtensions = ["jpg", "jpeg", "gif", "png"];
      $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

      if (!in_array($fileExtension, $validExtensions)) {
        $errors["photo"] = "Invalid file extension, must be: " . implode(", ", $validExtensions);
      }
      
      // Check file size (not too big) using php.ini config and MAX_FILE_SIZE set in the form
      // You can also manually check the ["size"] of the file
      if (
        $_FILES["photo"]["error"] === UPLOAD_ERR_FORM_SIZE ||
        $_FILES["photo"]["error"] === UPLOAD_ERR_INI_SIZE
      ) {
        $errors["photo"] = "File is too large.";
      }

      // NODO: Add other file upload validation

      // Make sure there are no file errors detected
      if (empty($errors["photo"])) {

        // OPTIONAL: Change the file name
        // $fileName = "xxxxx.$fileExtension";

        $moveFrom = $_FILES["photo"]["tmp_name"];
        $moveTo = $targetDirectory . $fileName;

        // Move uploaded file from the temp location into the target location
        if (move_uploaded_file($moveFrom, $moveTo)) {

          // Success
          $photoPath = $fileName;

        } else {

          // Error
          $errors["photo"] = "Uploaded file could not be moved.";

        }
      }
    }

    /* 
     * Check for errors and display results
     */

    // Check if we have errors (invalid data)
    if (count($errors) > 0) {

      // Invalid - redisplay the form with errors
      include_once TEMPLATES_DIR . "_addEmployeePage.html.php";
      
    } else {

      // Valid - add the employee to the database

      // Define SQL query
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