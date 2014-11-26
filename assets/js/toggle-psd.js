jQuery(document).ready(function($) {

    var getShownNodeId = function() {

        return $('.toggle-psd-node[data-state="shown"]').attr( 'data-node-id' );
    }

    var turnOffAllNodes = function() {

        return $('.toggle-psd-node').turnOff();
    }

    $.fn.getNodeId = function() {

        return $(this).attr('data-node-id');
    }

    $.fn.turnOff = function() {

        return this.each(function() {

            $(this).attr( 'data-state', 'hidden' );
        });
    }

    $.fn.turnOn = function() {

        return $(this).attr( 'data-state', 'shown' );
    }

    $.fn.positionNode = function() {

        var nodeWidth = $(this).find('.toggle-psd-overlay-image').attr('width'),
            nodePosition = '-' + ( nodeWidth / 2 ) + 'px';

        return $(this).css( 'margin-left', nodePosition );
    }

    $.fn.toggleState = function() {

        var state = $(this).attr( 'data-state' );

        switch ( state ) {

            case 'hidden' :
                return $(this).turnOn();
                break;

            case 'shown' :
                return $(this).turnOff();
                break;

            default :
                break;
        }
    }

    $.fn.togglePSD = function() {

        var nodeId = $(this).getNodeId(),
            currentNodeId = getShownNodeId(),
            footerNodeSelector = '#footer-toggle-psd-default .toggle-psd-node[data-node-id="' + nodeId + '"]';

        if ( undefined !== currentNodeId && currentNodeId == nodeId ) {

            $(this).turnOff();
            $(footerNodeSelector).turnOff();
            return;
        }

        turnOffAllNodes();
        $(this).toggleState();
        $(footerNodeSelector).toggleState().positionNode();
    }

    $('#wp-admin-bar-toggle-psd-default').on( 'click', '.toggle-psd-node', function() {

        $(this).togglePSD();
    });
});