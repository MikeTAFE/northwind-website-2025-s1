<?php
  
  // References/includes
  require_once INCLUDES_DIR . "formHelpers.php";

?>

<h2>Add new staff member</h2>

<p>Hired someone new? Add them here!</p>

<?php include TEMPLATES_DIR . "_errorSummary.html.php" ?>

<form action="addEmployee.php" method="post" novalidate>
  <fieldset>
    <legend>Personal information</legend>

    <div class="form-row">
      <label for="title">Title:</label>
      <input type="text" list="title-list" id="title" name="title" placeholder="Ms" <?= setValue("title") ?>>
      <datalist id="title-list">
        <option value="Mr"></option>
        <option value="Mrs"></option>
        <option value="Ms"></option>
        <option value="Dr"></option>
        <option value="Prof"></option>
      </datalist>
    </div>

    <div class="form-row">
      <label for="firstName">First name:</label>
      <input type="text" id="firstName" name="firstName" placeholder="Test" required <?= setValue("firstName") ?>>
    </div>

    <div class="form-row">
      <label for="lastName">Last name:</label>
      <input type="text" id="lastName" name="lastName" placeholder="Person" <?= setValue("lastName") ?>>
    </div>

    <div class="form-row">
      <label for="dateOfBirth">Date of birth:</label>
      <input type="date" id="dateOfBirth" name="dateOfBirth" <?= setValue("dateOfBirth") ?>>
    </div>

  </fieldset>
  <fieldset>
    <legend>Position information</legend>

    <div class="form-row">
      <label for="position">Position:</label>
      <input type="text" id="position" name="position" <?= setValue("position") ?>>
    </div>

    <div class="form-row">
      <label for="hireDate">Hire date:</label>
      <input type="date" id="hireDate" name="hireDate" <?= setValue("hireDate") ?>>
    </div>

    <div class="form-row">
      <label for="salary">Salary:</label>
      <input type="number" min="0" step="0.01" max="99999" id="salary" name="salary" <?= setValue("salary") ?>>
    </div>

    <div class="form-row">
      <label for="reportsTo">Reports to:</label>
      <input type="number" min="1" step="1" max="999" id="reportsTo" name="reportsTo" <?= setValue("reportsTo") ?>>
    </div>

    <div class="form-row">
      <label for="notes">Notes:</label>
      <textarea name="notes" id="notes" cols="30" rows="4"><?= getEncodedValue("notes") ?></textarea>
    </div>

    <div class="form-row">
      <button type="submit" name="submitAddEmployee">Add staff</button>
    </div>
  </fieldset>
</form>