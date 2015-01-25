jQuery(document).ready(function($) {

    TogglePSD = {};

    TogglePSD.Utils = {

        getJSON: togglePSDModels,

        // https://developer.mozilla.org/en-US/docs/Web/API/document.cookie
        setCookie: function ( sKey, sValue, vEnd, sPath, sDomain, bSecure ) {

            if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) { return false; }
            var sExpires = "";
            if (vEnd) {

                switch (vEnd.constructor) {

                    case Number:
                       sExpires = vEnd === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + vEnd;
                        break;

                    case String:
                        sExpires = "; expires=" + vEnd;
                        break;

                    case Date:
                        sExpires = "; expires=" + vEnd.toUTCString();
                        break;
                }
            }
            document.cookie = encodeURIComponent(sKey) + "=" + encodeURIComponent(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
            return true;
        },

        // https://developer.mozilla.org/en-US/docs/Web/API/document.cookie
        getCookie: function ( sKey ) {

            if (!sKey) { return null; }
            return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
        },
    };

    TogglePSD.dispatcher = _.clone( Backbone.Events );

    // Setup
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

    TogglePSD.ControlView = Backbone.View.extend({

        tagName: 'li',

        className: 'toggle-psd-node-container',

        events: {
            "click": "toggle"
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


    TogglePSD.Collection = Backbone.Collection.extend({

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
                width = this.$el.width();
                marginLeft = '-' + ( width / 2 ) + 'px';

            this.$el.attr( 'src', src ).css( 'margin-left', marginLeft );
        },
    });

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

    var collection = new TogglePSD.Collection();
    collection.createEachModel();

    var view = new TogglePSD.PSDCollectionView({

        collection: collection,
    });

    var model = new TogglePSD.TopLevelControl();
    new TogglePSD.TopLevelControlView({ model: model, collection: collection });

    view.render();
});