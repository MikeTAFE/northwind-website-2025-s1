<?php

  /**
   * Set an HTML-safe 'value' attribute of a form field from $_POST data.
   *
   * @param string $fieldName The name of the field to display.
   * @return string The HTML entity-encoded output for the form field.
   */
  function setValue(string $fieldName): string
  {
    // // Get the value from the POST data
    // $fieldValue = $_POST[$fieldName] ?? "";

    // // Safely encode the value for HTML output
    // $fieldValue = htmlspecialchars($fieldValue);

    // Get HTML-encoded POST data value
    $fieldValue = getEncodedValue($fieldName);

    // Generate HTML output
    return " value='$fieldValue'";
  }

  /**
   * Get an HTML-safe value of a form field from $_POST data.
   *
   * @param string $fieldName The name of the field to display.
   * @return string The HTML entity-encoded output for the form field.
   */
  function getEncodedValue(string $fieldName): string
  {
    // Get the value from the POST data
    $fieldValue = $_POST[$fieldName] ?? "";

    // Safely encode the value for HTML output
    $fieldValue = htmlspecialchars($fieldValue);

    // Generate HTML output
    return $fieldValue;
  }

  /**
   * Return the "checked" attribute if the field value is checked.
   *
   * @param string $fieldName The name of the field to display.
   * @param string $fieldValue The value of the field to compare against.
   * @return string The "checked" attribute if the field value matches.
   */
  function setChecked(string $fieldName, string $fieldValue): string
  {
    // Compare the value from the POST array with the supplied value, return "checked" if they match
    return ($_POST[$fieldName] ?? "") === $fieldValue ? "checked" : "";
  }

  /**
   * Return the "selected" attribute if the field value is selected.
   *
   * @param string $fieldName The name of the field to display.
   * @param string $fieldValue The value of the field to compare against.
   * @return string The "selected" attribute if the field value matches.
   */
  function setSelected(string $fieldName, string $fieldValue): string
  {
    // Compare the value from the POST array with the supplied value, return "selected" if they match
    return ($_POST[$fieldName] ?? "") === $fieldValue ? "selected" : "";
  }