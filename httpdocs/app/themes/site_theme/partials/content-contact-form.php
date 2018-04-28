<?php
/**
 * partials content-contact-form.php
 */
?>

  <?php $formData = ( isset( $_POST['theme_contact_form_nonce'] ) ) ? themeValidateAndSanitzeFields( themeGetDefaultFormData($_POST) ) : themeGetDefaultFormData();  ?>

  <?php if( isset($_GET['sent']) && $_GET['sent'] == 1 ): ?>
    <p class="form-message success">Thank you!  You're message was sent successfully.</p>
  <?php elseif( isset($_GET['error']) && is_string($_GET['error']) ): ?>
    <p class="form-message error"><?php echo $formData['errors']['sent']; ?></p>
  <?php endif; ?>

    <form action="<?php echo esc_url( the_permalink() ); ?>" id="contact-form" method="post" novalidate>
      <fieldset>
        <legend>Contact Form</legend>
        <p>* indicates a required field</p>
        <p>
          <?php themeDisplayFieldErrors($formData['errors'], 'contact-name'); ?>
          <label for="name">Your Name: *</label>
          <input type="text" id="name" name="contact-name" required value="<?php echo (!empty($formData['fields']['contact-name'])) ? $formData['fields']['contact-name'] : ''; ?>"/>
        </p>
        <p>
          <?php themeDisplayFieldErrors($formData['errors'], 'contact-email'); ?>
          <label for="email">Your Email Address: *</label>
          <input type="email" id="email" name="contact-email" required value="<?php echo (!empty($formData['fields']['contact-email'])) ? $formData['fields']['contact-email'] : ''; ?>"/>
        </p>
        <p>
          <?php themeDisplayFieldErrors($formData['errors'], 'contact-message'); ?>
          <label for="message">Message: *</label>
          <textarea name="contact-message" id="message" required><?php echo (!empty($formData['fields']['contact-message'])) ? $formData['fields']['contact-message'] : ''; ?></textarea>
        </p>
        <p>
          <input type="submit" value="submit"/>
          <?php wp_nonce_field( "theme_contact_form", "theme_contact_form_nonce", true, true ); ?>
        </p>
      </fieldset>
    </form>
