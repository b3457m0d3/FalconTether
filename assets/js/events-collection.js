apps.collections.events = Backbone.Collection.extend({
                model: window.apps.models.event,
                url: 'http://www.tarantism.us/api/events'
});

