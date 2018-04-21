<?php include dirname(__FILE__) . "/../templates/header.php"; ?>
  <article>
    <header>
      <h1>Contact Me</h1>
    </header>
    <p>If you want to get in touch complete the form below.</p>
    <form action="self" method="post">
      <fieldset>
        <legend>Contact Form</legend>
        <p>
          <label for="name">Your Name:</label>
          <input type="text" id="name" name="name" value="" required/>
        </p>
        <p>
          <label for="email">Your Email Address:</label>
          <input type="email" id="email" name="email" value="" required/>
        </p>
        <p>
          <label for="message">Message:</label>
          <textarea name="message" id="message" required></textarea>
        </p>
        <p>
          <input type="submit" value="submit" />
        </p>
      </fieldset>
    </form>
  </article>
<?php include dirname(__FILE__) . "/../templates/footer.php"; ?>
