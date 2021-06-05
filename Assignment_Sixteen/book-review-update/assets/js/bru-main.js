(function ($) {
  $(document).ready(function () {
    let id = $(".rating").data("id");
    let link = $(".rating").data("link");
    let rating = $(".rating").data("rating");

    let message_container = $("#rating_message");

    let options = {
      max_value: 5,
      step_size: 0.5,
      initial_value: rating,
      cursor: "pointer",
      readonly: false,
      change_once: false,
      ajax_method: "POST",
      url: brubj.ajax_url,
      additional_data: {
        action: "handle_rating_request",
        nonce: brubj.nonce,
        post_id: id,
        permalink: link,
      }, 
    };

    $(".rating").rate(options);

    $(".rating").on("updateSuccess", function (ev, data) {
      let notice = Object.keys(data.data)[0];

      switch (notice) {
        case "message":
          message_container
            .css({
              padding: "5px",
              border: "2px solid green",
              textAlign: "center",
              color: "orange",
            })
            .text(data.data.message)
            .fadeIn("slow");
          break;
        case "nonce_error":
        case "rating_error":
        case "error":
          message_container
            .css({
              padding: "5px",
              border: "2px solid red",
              textAlign: "center",
              color: "red",
            })
            .text(
              data.data.nonce_error || data.data.rating_error || data.data.error
            )
            .fadeIn("slow");
          break;
        case "default":
          message_container
            .css({
              padding: "5px",
              textAlign: "center",
            })
            .text(data.data.message)
            .fadeIn("slow");
          break;
      }

      if (data.data.redirect_url) {
        window.location.href = data.data.redirect_url;
        message_container.hide();
      }

      if (data.data.read_only) {
        $(".rating").rate({
          readonly: true,
          max_value: 5,
          step_size: 0.5,
          initial_value: 0,
          cursor: "pointer",
        });
      }
    });
  });
})(jQuery);
