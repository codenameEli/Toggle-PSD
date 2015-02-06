TogglePSD.PSDCollectionView = Backbone.View.extend({

    el: 'html',

    collection: null,

    events: {
        "keypress": "toggle"
    },

    toggle: function( event ) {

        if ( event.charCode === 96 ) {

            var modelId = TogglePSD.Utils.getCookie( 'psd-model' );

            if ( null === modelId ) { return; }

            var model = this.collection.get( modelId ),
                state = model.get( 'state' );

            if ( state === 'shown' ) {

                TogglePSD.dispatcher.trigger( 'toggledOff', model );
                model.set({ 'state': 'hidden' });
            }
            else {

                TogglePSD.dispatcher.trigger( 'toggledOn', model );
                model.set({ 'state': 'shown' });
            }
        }
    },

    initialize: function( options ) {

        this.collection = options.collection;
        this.psdViews = [];
        this.createPSDViews();
    },

    createPSDViews: function() {

        console.log(this.collection);
        this.collection.each( function( model ) {

            this.psdViews.push( new TogglePSD.PSDView({ model: model }) );
        }, this );
    },

    render: function() {

        _.each( this.psdViews, function( view ){

            this.$el.append( view.$el );
            view.render();
        }, this );
    },
});