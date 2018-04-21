<?php
/**
 * contact form field errors template.
 *
 * @context [string] $fieldErrors
 */
?>
<?php foreach($fieldErrors as $error): ?>
  <span class="form-error error"><?php echo $error; ?></span>
<?php endforeach; ?>
