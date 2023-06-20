(function ($, Drupal) {
    $.fn.testing = function() {
        alert("submitted");
        $("#custom-demo-get-user-details").submit();
    };

}(jQuery, Drupal));

(function ($) {
    $(document).ready(function () {
        var $permanentAdd = $('#same-as-permanent');
        var $tempAdd = $('.form-item-temporary-address');
//on load
        if ($permanentAdd.is(':checked')) {
            $tempAdd.hide();
        }

        $permanentAdd.on('change', function () {
        if ($(this).is(':checked')) {
            $tempAdd.hide();
        } else {
            $tempAdd.show();
        }
        });
    });
})(jQuery);