TogglePSD.Control = Backbone.Model.extend({

    defaults: {
        title: '',
        state: 'hidden',
        loaded: false,
        imageSource: '',
    },

    initialize: function() {

        console.log(this);
    },

    equals: function( model ) {

        return this.cid == model.cid;
    }
});