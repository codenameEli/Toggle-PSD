TogglePSD.PSDView = Backbone.View.extend({

    tagName: 'img',

    className: 'overlay',

    events: {
        "mousedown": "toggle"
    },

    initialize: function() {

        this.listenTo( this.model, "change:state", this.onStateChange );
    },

    onStateChange: function() {

        console.log( 'onStateChange PSDView');
        var model = this.model,
            state = model.get( 'state' );

        if ( state === 'shown' ) {

            this.$el.show();
        }
        else {

            this.$el.hide();
        }
    },

    toggle: function( event ) {

        if ( event.which == 3 ) {

            var model = this.model;

            TogglePSD.dispatcher.trigger( 'toggledOff', model );

            setTimeout( function(){
                TogglePSD.dispatcher.trigger( 'toggledOn', model );
            }, 3000 );
        }
    },

    render: function() {

        this.onStateChange();
        var src = this.model.get( 'imageSource' ),
            width = this.model.get( 'width' );
            marginLeft = '-' + ( width / 2 ) + 'px';

        this.$el.attr( 'src', src ).css( 'margin-left', marginLeft );
    },
});