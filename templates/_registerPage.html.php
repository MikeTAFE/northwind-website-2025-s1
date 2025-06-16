<?php
  
  // References/includes
  // require_once __DIR__ . "/../includes/formHelpers.php";
  // require_once ROOT_DIR . "includes/formHelpers.php";
  require_once INCLUDES_DIR . "formHelpers.php";

?>

<h2>Register</h2>

<p>Please fill out the registration form.</p>

<?php include TEMPLATES_DIR . "_errorSummary.html.php" ?>

<form id="register-form" action="register.php" method="post" novalidate>
  <fieldset>
    <legend>Personal information</legend>

    <div class="form-row">
      <label for="firstName">First name:</label>
      <input type="text" id="firstName" name="firstName" required <?= setValue("firstName") ?>>
    </div>

    <div class="form-row">
      <label for="lastName">Last name:</label>
      <input type="text" id="lastName" name="lastName" placeholder="Last name" <?= setValue("lastName") ?>>
    </div>

    <div class="form-row">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="name@email.com" <?= setValue("email") ?>>
    </div>

    <div class="form-row">
      <label for="password1">Password:</label>
      <input type="password" id="password1" name="password1" <?= setValue("password1") ?>>
    </div>

    <div class="form-row">
      <label for="password2">Re-type Password:</label>
      <input type="password" id="password2" name="password2" <?= setValue("password2") ?>>
    </div>

    <div class="form-row">
      <label for="course">Enrolled in:</label>
      <select name="course" id="course">
        <option <?= setSelected("course", "c4-web") ?> value="c4-web">Cert 4 Web Design</option>
        <option <?= setSelected("course", "dip-web") ?> value="dip-web">Diploma Web Development</option>
        <option <?= setSelected("course", "c4-prog") ?> value="c4-prog">Cert 4 Programming</option>
        <option <?= setSelected("course", "dip-prog") ?> value="dip-prog">Diploma Advanced Programming</option>
      </select>
    </div>

    <div class="form-row">
      <p>
        Enrolment mode:
        <label class="error" for="enrolmentMode"></label>
      </p>
      <label>
        <input type="radio" name="enrolmentMode" value="ft" <?= setChecked("enrolmentMode", "ft") ?>>
        Full-time
      </label>
      <label>
        <input type="radio" name="enrolmentMode" value="pt" <?= setChecked("enrolmentMode", "pt") ?>>
        Part-time
      </label>
    </div>

    <div class="form-row">
      <input type="checkbox" name="newsletter" id="newsletter" value="yes" <?= setChecked("newsletter", "yes") ?>>
      <label for="newsletter">Sign up to newsletter?</label>
    </div>

    <div class="form-row">
      <label for="comments">Any comments?</label>
      <textarea name="comments" id="comments" cols="30" rows="4"><?= getEncodedValue("comments") ?></textarea>
    </div>

    <div class="form-row">
      <input type="checkbox" name="terms" id="terms" value="yes" <?= setChecked("terms", "yes") ?>>
      <label for="terms">Agree to terms &amp; conditions</label>
      <label for="terms" class="error"></label>
    </div>

    <div class="form-row">
      <!-- <button type="submit" name="action" value="register">Register</button> -->
      <button type="submit" name="submitRegister">Register</button>
    </div>
  </fieldset>
</form>

<?php $footerScripts = <<<HTML
  <script src="scripts/registerPageValidation.js"></script>
HTML;
