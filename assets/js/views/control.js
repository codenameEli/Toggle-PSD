TogglePSD.ControlView = Backbone.View.extend({

    tagName: 'li',

    className: 'toggle-psd-node-container',

    events: {
        "click": "toggle"
    },

    toggleDraggable: function() {

        console.log("IFHEIWFHI");
    },

    initialize: function() {

        this.onStateChange = _.bind( this.onStateChange, this );
        this.onStateChange();
        this.listenTo( this.model, 'change:state', this.onStateChange );
    },

    onStateChange: function() {

        console.log('onStateChange modelView');
        var model = this.model,
            state = model.get( 'state' );

        if ( state === 'shown' ) {

            this.$el.find('.toggle-psd-node').attr( 'data-state', 'shown' );
        }
        else {

            this.$el.find('.toggle-psd-node').attr( 'data-state', 'hidden' );
        }
    },

    toggle: function() {

        var model = this.model,
            state = model.get( 'state' );

        if ( state === 'shown' ) {

            TogglePSD.dispatcher.trigger( 'toggledOff', this.model );
        }
        else {

            TogglePSD.dispatcher.trigger( 'toggledOn', this.model );
        }
    }
});