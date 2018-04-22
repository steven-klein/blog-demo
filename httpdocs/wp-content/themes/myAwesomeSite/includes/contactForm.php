<?php
/**
 * includes/contactForm.php
 *
 * @return void
 */

/**
 * return the global form fields data for our contact form.
 *
 * @return array
 */
function themeGetDefaultFormData($postData = []) {
  return [
    "errors" => [],
    "fields" => array_merge([
      "contact-name" => "",
      "contact-email" => "",
      "contact-message" => ""
    ], $postData)
  ];
}

/**
 * add a shortcode for displaying the form.
 * @hooked after_setup_theme
 *
 * @return void
 */
add_action("after_setup_theme", "themeaddContactFormShortcode", 10);
function themeaddContactFormShortcode() {
  add_shortcode("theme-contact-form", "themeContactFormTemplate");
}


 /**
  * output the contact form template.
  * @shortcode theme-contact-form
  *
  * @return void
  */
function themeContactFormTemplate() {
  ob_start();
  include get_stylesheet_directory() . "/partials/content-contact-form.php";
  return ob_get_clean();
}

/**
 * check for post data on init and trigger our contact form process if valid.
 * @hooked init
 *
 * @return void
 */
add_action("init", "maybeSetupContactFormHook");
function maybeSetupContactFormHook() {
  if( isset($_POST["theme_contact_form_nonce"]) && wp_verify_nonce($_POST["theme_contact_form_nonce"], "theme_contact_form") ) {
    do_action("theme_process_contact_form", $_POST);
  }
}

/**
 * process the contact form and send an email if valid.
 * @hooked admin_post_nopriv_theme_contact_form
 * @hooked admin_post_theme_contact_form
 *
 * @return void
 */
add_action("theme_process_contact_form", "themeProcessContactForm", 1, 1);
function themeProcessContactForm($postData) {

  // establish the default form data.
  $formData = themeGetDefaultFormData($postData);

  // default boolean value if the message is sent.
  $sent = null;

  // validate and santize the submitted forms.
  $formData = themeValidateAndSanitzeFields($formData);

  // if no errors were found send an email
  if( empty($formData["errors"]) ) {
    // setup the message we are going to send.
    $message = sprintf("New contact form message from %s <%s>:\n\n%s", $formData["fields"]["contact-name"], $formData["fields"]["contact-email"], $formData["fields"]["contact-message"]);
    // use the mail funciton to send the message.
    // if mail is sent successfully, set success to true.
    $sent = ( wp_mail( get_option('admin_email'), "Contact form message", $message ) === true) ? true : false;
  }

  // add an error message for the frontend to use that we tried to process a valid form, but encountered an error.
  if( $sent === false ) {
    $$formData["errors"]["sent"] = "An unknown error occurred trying to send your message.";
  }

  // if we sent a message. add an arg and redirect back
  if($sent === true) {
    // establish a redirect url possibly.
    $redirect = ( isset($postData["_wp_http_referer"]) && filter_var(home_url($postData["_wp_http_referer"]), FILTER_VALIDATE_URL) ) ? filter_var(home_url($postData["_wp_http_referer"]), FILTER_SANITIZE_URL) : home_url();

    // do a safe wp redirect.
    wp_safe_redirect( add_query_arg(["sent" => 1], $redirect ), 302 );

    exit;
  }
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

      case "contact-name":
        if( empty($value) ) {
          // if the field value is empty add an error for that field.
          $formData["errors"][$field][] = "Your name is a required field.";
        }
        break;

      case "contact-email":
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

      case "contact-message":
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
function themeDisplayFieldErrors($errors = [], $field = "") {
  if( isset($errors[$field]) && is_array($errors[$field]) ) {
    $fieldErrors = $errors[$field];
    include get_stylesheet_directory() . "/partials/content-form-error.php";
  }
}
