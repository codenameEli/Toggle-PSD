jQuery(document).ready(function($) {

    var collection = new TogglePSD.ControlCollection();
    collection.createEachModel();

    var view = new TogglePSD.PSDCollectionView({

        collection: collection,
    });

    var model = new TogglePSD.TopLevelControl();
    new TogglePSD.TopLevelControlView({ model: model, collection: collection });

    view.render();
});