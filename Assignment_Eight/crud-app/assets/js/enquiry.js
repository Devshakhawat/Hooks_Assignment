; (function ($) {
	$("#wd-enquiry-form").on("submit", function (e) {
		e.preventDefault()
		let data = $(this).serialize()

		$.post(enquiry_obj.ajaxurl, data)

			.done(function (response) {
				alert(response.data.message)
			})

			.fail(function () {
				alert(enquiry_obj.error);
			})

	})
})(jQuery);
