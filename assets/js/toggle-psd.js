jQuery(document).ready(function($) {

    $.fn.turnOff = function() {

        return $(this).removeClass('state-active').addClass('state-hidden');
    }

    $.fn.positionOverlay = function() {

        var overlay = $(this).find('img'),
            overlayWidth = $(overlay).attr('width'),
            position = '-' + ( overlayWidth / 2 ) + 'px';

        return $(overlay).css( 'margin-left', position );
    };

    $.fn.toggleState = function() {

        return $(this).toggleClass('state-active').toggleClass('state-hidden');
    };

    // Find the data number of each admin bar
    $.fn.toggleDisplay = function() {

        var adminBarItem = $(this),
            imageNumber = adminBarItem.find('.toggle-psd-overlay').data('psd-number');

        $('#listOfOverlays .overlay-image').each(function(){

            var overlayNumber = $(this).data('psd-number');

            if ( overlayNumber !== imageNumber ) {

                $(this).children().turnOff();
                return;
            }

            // Toggle state on
            adminBarItem.toggleState();
            $(this).positionOverlay().toggleState();

        });
    };

    var $adminBar = $('#wp-admin-bar-toggle-psd');

    $adminBar.on( 'click', '.toggle-psd-item', function() {

        return $(this).toggleDisplay();
    });
});