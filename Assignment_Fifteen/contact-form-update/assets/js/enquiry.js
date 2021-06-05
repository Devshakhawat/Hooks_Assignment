;(function($) {
	$(document).ready(function() {
		$( '#contact' ).on( 'submit', function(e) {
			e.preventDefault(); 

			$.ajax({
				type: "POST",
				url:  enquiry_obj.ajaxurl,
				data: new FormData($(this)[0]),
				processData: false,
				contentType: false,
				success: function(res){
					$( '.notice' ).text(res.data.message);
				}
			});
		} )
	})
})(jQuery);