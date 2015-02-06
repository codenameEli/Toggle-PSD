TogglePSD.TopLevelControlView = Backbone.View.extend({

    el: '#wp-admin-bar-toggle-psd',

    events: {
        "click .ab-item": "toggle"
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

            console.log(state);

        if ( state === 'shown' ) {

            this.$el.attr( 'data-state', 'shown' );
        }
        else {

            this.$el.attr( 'data-state', 'hidden' );
        }
    },

    toggle: function() {

        var modelId = TogglePSD.Utils.getCookie( 'psd-model' );

        if ( null === modelId ) { return; }

        var model = this.collection.get( modelId ),
            state = model.get( 'state' );

        if ( state === 'shown' ) {

            TogglePSD.dispatcher.trigger( 'toggledOff', model );
            this.model.set({ 'state': 'hidden' });
        }
        else {

            TogglePSD.dispatcher.trigger( 'toggledOn', model );
            this.model.set({ 'state': 'shown' });
        }
    }
});