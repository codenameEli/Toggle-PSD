TogglePSD.ControlCollection = Backbone.Collection.extend({

    model: TogglePSD.Control,

    initialize: function() {

        TogglePSD.dispatcher.on( "toggledOn", this.onToggledOn, this );
        TogglePSD.dispatcher.on( "toggledOff", this.onToggledOff, this );
    },

    onToggledOn: function( model ) {
        console.log('onToggledOn collection');
        var pModel = model;
        TogglePSD.Utils.setCookie( 'psd-model', model.cid );

        this.each( function( model ){

            if ( model.equals( pModel ) ) {

                pModel.set({ 'state': 'shown' });
            }

            else if ( model.get('state') === 'shown' ) {

                model.set({ 'state': 'hidden' });
            }
        });
    },

    onToggledOff: function( model ) {
        console.log('onToggledOff collection');

        model.set({ 'state': 'hidden' });
    },

    createEachModel: function() {

        _.each( TogglePSD.Utils.getJSON, function( model, key, list ){

            var newModel = new TogglePSD.Control({
                title: model.title,
                imageSource: model.imageSource,
                width: model.width,
                element: model.element
            });

            new TogglePSD.ControlView({
                model: newModel,
                el: model.element
            });

            this.add(newModel);
        }, this);
    }
});