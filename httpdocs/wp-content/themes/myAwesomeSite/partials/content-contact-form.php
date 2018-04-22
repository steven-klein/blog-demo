  <?php $formData = themeProcessForm(); // must be run before headers are sent since it may send headers. ?>

  <?php if( isset($_GET['sent']) && $_GET['sent'] == 1 ): ?>
    <p class="form-message success">Thank you!  You're message was sent successfully.</p>
  <?php elseif( isset($formData['errors']['sent']) ): ?>
    <p class="form-message error"><?php echo $formData['errors']['sent']; ?></p>
  <?php endif; ?>

    <p>If you want to get in touch complete the form below.</p>

    <form action="<?php get_permalink(); ?>" id="contact-form" method="post" novalidate>
      <fieldset>
        <legend>Contact Form</legend>
        <p>* indicates a required field</p>
        <p>
          <?php themeMayDisplayFieldErrors($formData['errors'], 'name'); ?>
          <label for="name">Your Name: *</label>
          <input type="text" id="name" name="name" required value="<?php echo (!empty($formData['fields']['name'])) ? $formData['fields']['name'] : ''; ?>"/>
        </p>
        <p>
          <?php themeMayDisplayFieldErrors($formData['errors'], 'email'); ?>
          <label for="email">Your Email Address: *</label>
          <input type="email" id="email" name="email" required value="<?php echo (!empty($formData['fields']['email'])) ? $formData['fields']['email'] : ''; ?>"/>
        </p>
        <p>
          <?php themeMayDisplayFieldErrors($formData['errors'], 'message'); ?>
          <label for="message">Message: *</label>
          <textarea name="message" id="message" required><?php echo (!empty($formData['fields']['message'])) ? $formData['fields']['message'] : ''; ?></textarea>
        </p>
        <p>
          <input type="submit" value="submit" />
        </p>
      </fieldset>
    </form>
