(function ($) {
  "use strict";

  /**
   * All of the code for your admin-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */

  jQuery(document).ready(function ($) {
    var generate_button = $("#generate-ai-magic-content");

    generate_button.on("click", function () {
      var content = $("#ai-magic-content").val();

      generate_button.prop("disabled", true);
      generate_button.html("Generating ...");

      var postData = $("#ai-magic-content").val();

      $.ajax({
        type: "POST",
        url: ajaxurl,
        data: {
          action: "save_generate_text", // Define the action
          ai_magic_try_text: postData, // Send the form data
        },
        success: function (response) {
          if (response.error) {
            $("#ai-magic-message").html(
              '<div id="message" class="updated error is-dismissible"><p>' +
                response.message +
                "</p></div>"
            );

            generate_button.prop("disabled", false);
            generate_button.html("Generate Text .");
            return;
          }

          if (response.success) {
            $("#ai-magic-message").html(
              '<div id="message" class="updated notice is-dismissible"><p>' +
                response.data.message +
                "</p></div>"
            );

            var data = response.data.data;

            wp.data
              .dispatch("core/editor")
              .editPost({ title: data.post_title });

            wp.data
              .dispatch("core/editor")
              .editPost({ excerpt: data.post_excerpt });

            wp.data
              .dispatch("core/editor")
              .editPost({ content: data.post_content });
          } else {
            $("#ai-magic-message").html(
              '<div id="message" class="updated error is-dismissible"><p>' +
                response.data.message +
                "</p><p>" +
                response.data.text +
                "</p></div>"
            );
          }

          generate_button.prop("disabled", false);
          generate_button.html("Regenerate");
        },
        error: function (xhr, status, error) {
          generate_button.prop("disabled", false);
          generate_button.html("Regenerate");
        },
      });
    });
  });
})(jQuery);
