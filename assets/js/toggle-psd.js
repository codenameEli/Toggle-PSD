jQuery(document).ready(function($) {

    $.fn.turnOff = function() {

        return $(this).removeClass('state-active').addClass('state-hidden');
    }

    $.fn.positionOverlay = function() {

        var overlay = $(this).find('img'),
            overlayWidth = $(overlay).attr('width'),
            position = '-' + ( overlayWidth / 2 ) + 'px';

        return $(overlay).css( 'margin-left', position ).toggleState();
    };

    $.fn.toggleState = function() {

        return $(this).toggleClass('state-active').toggleClass('state-hidden');
    };

    // Find the data number of each admin bar
    $.fn.displayOverlay = function() {

        var imageNumber = $(this).find('.toggle-psd-overlay').data('psd-number');

        $('#listOfOverlays .overlay-image').each(function(){

            var overlayNumber = $(this).data('psd-number');

            if ( overlayNumber !== imageNumber ) {

                $(this).children().turnOff();
                return;
            }

            $(this).positionOverlay();

        });
    };

    var $adminBar = $('#wp-admin-bar-toggle-psd');

    $adminBar.on( 'click', '.toggle-psd-item', function() {

        return $(this).toggleState().displayOverlay();
    });
});