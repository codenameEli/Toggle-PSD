TogglePSD.TopLevelControl = Backbone.Model.extend({

    defaults: {
        state: "hidden"
    },

    initialize: function() {

        TogglePSD.dispatcher.on( "toggledOn", this.onToggledOn, this );
        TogglePSD.dispatcher.on( "toggledOff", this.onToggledOff, this );
    },

    onToggledOn: function() {

        this.set({ "state": "shown" });
    },

    onToggledOff: function() {

        this.set({ "state": "hidden" });
    },
});