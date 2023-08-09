// (function ($, Drupal, drupalSettings) {

//     Drupal.behaviors.MyModuleBehavior = {
//         attach: function (context, settings) {
//         var testing = drupalSettings.pragathi_exercise.testing;
//         console.log(testing)
//         $('body').css('background', testing);
//         }
//     };

//     $.fn.testing = function() {
//     console.log("submitted");
//         $("#custom-demo-get-user-details").submit();
//     };


//     $(document).ready(function () {
//         var $permanentAdd = $('#same-as-permanent');
//         var $tempAdd = $('.form-item-temporary-address');
// //on load
//         if ($permanentAdd.is(':checked')) {
//             $tempAdd.hide();
//         }

//         $permanentAdd.on('change', function () {
//         if ($(this).is(':checked')) {
//             $tempAdd.hide();
//         } else {
//             $tempAdd.show();
//         }
//         });
//     });


//     $(document).ready(function () {
//         console.log("working");
//     });

// }(jQuery, Drupal, drupalSettings));



(function () {
    function MyModuleBehavior() {
        var testing = drupalSettings.pragathi_exercise.testing;
        console.log(testing);
        document.body.style.background = testing;
    }

    function testingFunction() {
        console.log("submitted");
        document.getElementById("custom-demo-get-user-details").submit();
    }

    document.addEventListener('DOMContentLoaded', function () {
        var permanentAdd = document.getElementById('same-as-permanent');
        var tempAdd = document.querySelector('.form-item-temporary-address');

        // On load
        if (permanentAdd.checked) {
            tempAdd.style.display = 'none';
        }

        permanentAdd.addEventListener('change', function () {
            if (permanentAdd.checked) {
                tempAdd.style.display = 'none';
            } else {
                tempAdd.style.display = 'block';
            }
        });

        console.log("working");
    });

    if (typeof Drupal !== 'undefined' && typeof Drupal.behaviors !== 'undefined') {
        Drupal.behaviors.MyModuleBehavior = {
            attach: function () {
                MyModuleBehavior();
                testingFunction();
            }
        };
    }
})();
