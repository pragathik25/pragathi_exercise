// (function ($, Drupal) {
//     $.fn.testing = function() {
//         alert("submitted");
//         $("#custom-demo-get-user-details").submit();
//     };

// }(jQuery, Drupal));

(function ($) {
    $(document).ready(function () {
      // Select the checkbox and temporary address field by their IDs.
      var $sameAsPermanent = $('#edit-same-as-permanent');
      var $temporaryAddress = $('#edit-temporary-address');

      // Initially hide the temporary address field if the checkbox is checked.
      if ($sameAsPermanent.is(':checked')) {
        $temporaryAddress.hide();
      }

      // Attach an event handler to the checkbox to toggle the visibility of the temporary address field.
      $sameAsPermanent.on('change', function () {
        if ($(this).is(':checked')) {
          $temporaryAddress.hide();
        } else {
          $temporaryAddress.show();
        }
      });
    });
})(jQuery);