<?php
/**
 * MyAwesomeSite functions.php
 */

// enqueue asstes.

// shortcode for post lists.

// shortcode for the contact form.


/**
 * process the contact form and send an email if valid.
 *
 * @return array $formData
 */
function themeProcessForm() {
  // establish the default form fields we care about.
  $defaultFormFields = [
    "name" => "",
    "email" => "",
    "message" => ""
  ];
  // default boolean value if the message is sent.
  $sent = false;
  // setup some basic form data that will be easy to use on the frontend.
  // this will always be returned, simplifying templating logic.
  $formData = [
    "errors" => [],
    "fields" => array_merge($defaultFormFields, $_POST) // merge posted fields with the defaults.
  ];
  // if $_POST data isn't set then a form wasn't submitted.
  if( $_SERVER["REQUEST_METHOD"] !== "POST" || empty($_POST) ) return $formData;
  // validate and santize the submitted forms.
  $formData = themeValidateAndSanitzeFields($formData);
  // if no errors were found send an email
  if( empty($formData["errors"]) ) {
    // setup the message we are going to send.
    $message = sprintf("New contact form message from %s <%s>:\n\n%s", $formData["fields"]["name"], $formData["fields"]["email"], $formData["fields"]["message"]);
    // use the mail funciton to send the message.
    // if mail is sent successfully, set success to true.
    $sent = ( wp_mail( get_option('admin_email'), "Contact form message", $message ) === true) ? true : false;
  }
  // add an error message for the frontend to use that we tried to process a valid form, but encountered an error.
  if( $sent === false && empty($formData["errors"]) ) {
    $formData["errors"]["sent"] = "An unknown error occurred trying to send your message.";
  }
  // if we sent a message. redirect the the contact page with as GET request with a sent param otherwise send the form data.
  return ($sent === true) ? header("Location: /contact.php?sent=1") : $formData;
}

/**
 * validate and sanitize our form fields.
 *
 * @param array $formData
 * @return array $formData
 */
function themeValidateAndSanitzeFields($formData) {
  // loop through the $_POST data validate it and sanitize it.
  foreach( $formData["fields"] as $field => $value ) {
    // check for any other required conditions and sanitize.
    switch($field) {
      case "name":
        if( empty($value) ) {
          // if the field value is empty add an error for that field.
          $formData["errors"][$field][] = "Your name is a required field.";
        }
        break;
      case "email":
        if( empty($value) ) {
          // if the field value is empty add an error for that field.
          $formData["errors"][$field][] = "Your email address is a required field.";
        }
        elseif( ! filter_var($value, FILTER_VALIDATE_EMAIL) ) {
          // an invalid email address was detected.  set an appropriate error message.
          $formData["errors"][$field][] = "$value appears to be an invalid email address.";
        } else {
          // a valid email address was used in the form, sanitize it accordingly
          $formData["fields"][$field] = filter_var($value, FILTER_SANITIZE_EMAIL);
        }
        break;
      case "message":
        if( empty($value) ) {
          // if the field value is empty add an error for that field.
          $formData["errors"][$field][] = "Please let me know what you're getting in contact about.";
        }
        break;
    }
    $formData["fields"][$field] = trim( filter_var($value, FILTER_SANITIZE_STRING) );
  }
  return $formData;
}

/**
 * include an error message template if a field contains errors.
 * this is helper function for the contact form template.
 *
 * @param array $errors
 * @param string $field
 * @return void
 */
function themeMayDisplayFieldErrors($errors = [], $field = "") {
  if( isset($errors[$field]) && is_array($errors[$field]) ) {
    $fieldErrors = $errors[$field];
    include get_stylesheet_directory() . "/partials/contact-form-error.php";
  }
}
