/**
 * assets/js/contactForm.js
 */
(function($){
	// validate our contact form.
	$("document").ready(setupContactFormValidation);

	/**
	 * attach the jquery.validate form handler to our contact form.
	 *
	 * @return void
	 */
	function setupContactFormValidation() {
		$("#contact-form").validate({
			errorPlacement: function (error, element) {
			error.insertBefore(element);
			},
			messages: {
			name: "Your name is a required field.",
			email: {
				required: "Your email address is a required field.",
				email: function () {
				return $("#email").val() + " appears to be an invalid email address."
				}
			},
			message: "Please let me know what you're getting in contact about."
			}
		});
	}
})(jQuery, window);
