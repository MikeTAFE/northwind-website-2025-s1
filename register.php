<?php

  // Common includes for main PHP pages (controllers)
  require_once "includes/common.php";

  // Include email sending functionality
  require_once INCLUDES_DIR . "emailHelpers.php";

  // Config
  $title = "Register";

  // Start output buffering
  ob_start();

  // Check if form has been submitted
  if (isset($_POST["submitRegister"])) {

    // Collection of all errors for this submission (none by default)
    $errors = [];
    
    // Get data passed to this page ($_POST superglobal array)
    $firstName = $_POST["firstName"] ?? "";
    $lastName = $_POST["lastName"] ?? "";
    $email = $_POST["email"] ?? "";
    $password1 = $_POST["password1"] ?? "";
    $password2 = $_POST["password2"] ?? "";
    $course = $_POST["course"] ?? "";
    $enrolmentMode = $_POST["enrolmentMode"] ?? "";
    $newsletterChecked = isset($_POST["newsletter"]);
    $comments = $_POST["comments"] ?? "";
    $termsChecked = isset($_POST["terms"]);

    // TESTING - manually adding error messages
    // $errors["firstName"] = "First name is required";
    // $errors["lastName"] = "Last name is required";

    // TODO: Normalise/sanitize data
    $firstName = trim($firstName);

    // Validate first name
    if ($firstName === "") {
      $errors["firstName"] = "First name is required";
    } else if (strlen($firstName) < 2) {
      $errors["firstName"] = "First name must be 2+ characters";
    }

    // Validate last name
    if ($lastName === "") {
      $errors["lastName"] = "Last name is required";
    } else if (strlen($lastName) < 2) {
      $errors["lastName"] = "Last name must be 2+ characters";
    }

    // Validate email
    if ($email === "") {
      $errors["email"] = "Email is required";
    }
    // Email pattern match
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors["email"] = "Invalid email pattern";
    }

    // Validate passwords
    if (strlen($password1) < 10) {
      $errors["password1"] = "Password must be 10+ characters";
    } else if ($password1 !== $password2) {
      $errors["password2"] = "Passwords don't match";
    }


    // Check if we have errors (invalid data)
    if (count($errors) > 0) {

      // Invalid - redisplay the form with errors
      include_once "templates/_registerPage.html.php";
      
    } else {

      // Valid - do something with the data

      /* 
       * Option 1: Save to database
       */


      /* 
       * Option 2: Send an email
       */

      // Encode values safely for output in HTML (email content and confirmation page)
      $firstName = htmlspecialchars($firstName);
      $lastName = htmlspecialchars($lastName);
      $email = htmlspecialchars($email);
      $course = htmlspecialchars($course);
      $enrolmentMode = htmlspecialchars($enrolmentMode);
      $comments = htmlspecialchars($comments);

      // Build email
      $toEmail = "michael.kirkwood-smith3@tafensw.edu.au";
      $subject = "Northwind Website registration form submission";
      $htmlBody = <<<HTML
      <h1>Northwind Website registration form submission</h1>
      <p>The Northwind Website registration form has been filled in.</p>
      <ul>
        <li>First Name: $firstName</li>
        <li>Last Name: $lastName</li>
        <li>Email: $email</li>
        <li>Course: $course</li>
        <li>Enrolment Mode: $enrolmentMode</li>
        <li>Comments: $comments</li>
      </ul>
      HTML;
      $altBody = <<<TEXT
      Northwind Website registration form submission

      The Northwind Website registration form has been filled in.

      - First Name: $firstName
      - Last Name: $lastName
      - Email: $email
      - Course: $course
      - Enrolment Mode: $enrolmentMode
      - Comments: $comments

      TEXT;

      // Send email
      $emailSentSuccessfully = sendEmail($toEmail, $subject, $htmlBody, $altBody);

      // Optional: Do something different if the email sending fails


      /* 
       * Option 3: Display confirmation message
       */

      // Valid - display confirmation
      include_once "templates/_registerConfirmation.html.php";


      /* 
       * Option 4: Redirect to another page
       */

      // Remember the exit with the "Location" header!
      // If you want to pass data to the redirected page, use a query string (?firstName=Mike) or the $_SESSION array
      // header("Location: someConfirmationPage.php");
      // exit;

    }

  } else {

    // Just display the empty form
    include_once "templates/_registerPage.html.php";

  }

  // Stop output buffering
  $content = ob_get_clean();

  // Include the main layout template
  include_once "templates/_layout.html.php";