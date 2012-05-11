$(function(){
    var Event = Backbone.Model.extend({
	defaults:{
	    title:'untitled',
	    color:'#f00'
	}
    });
    var Events = Backbone.Collection.extend({
        model: Event,
        url: 'http://www.tarantism.us/api/events'
    });
    var EventsView = Backbone.View.extend({
        _construct: function(){
            _.bindAll(this);
            //collection binding
            this.collection = new Events();
            this.collection.bind('reset', this.addAll);
            this.collection.bind('add', this.addOne);
            this.collection.bind('change', this.change);            
            this.collection.bind('destroy', this.destroy);
            this.collection.fetch();
            
            this.eventView = new EventView();
            
            this.render();
        },
        render: function() {
            this.el.fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                selectable: true,
                selectHelper: true,
                editable: true,
                ignoreTimezone: false,                
                select: this.select,
                eventClick: this.eventClick,
                eventDrop: this.eventDropOrResize,        
                eventResize: this.eventDropOrResize
            });
        },
        addAll: function() {
            this.el.fullCalendar('addEventSource', this.collection.toJSON());
        },
        addOne: function(event) {
            this.el.fullCalendar('renderEvent', event.toJSON());
        },        
        select: function(startDate, endDate) {
            this.eventView.collection = this.collection;
            this.eventView.model = new Event({start: startDate, end: endDate});
            this.eventView.render();            
        },
        eventClick: function(fcEvent) {
            this.eventView.model = this.collection.get(fcEvent.id);
            this.eventView.render();
        },
        change: function(event) {
            var fcEvent = this.el.fullCalendar('clientEvents', event.get('id'))[0];
            fcEvent.title = event.get('title');
            fcEvent.color = event.get('color');
            this.el.fullCalendar('updateEvent', fcEvent);           
        },
        eventDropOrResize: function(fcEvent) {
            this.collection.get(fcEvent.id).save({start: fcEvent.start, end: fcEvent.end});            
        },
        destroy: function(event) {
            this.el.fullCalendar('removeEvents', event.id);         
        }        
    });

    var EventView = Backbone.View.extend({
        el: $('#eventDialog'),
        _construct: function() {
            _.bindAll(this);           
        },
        render: function() {
            var buttons = {'Ok': this.save};
            if (!this.model.isNew()) _.extend(buttons, {'Delete': this.destroy});
            _.extend(buttons, {'Cancel': this.close});            
            this.el.dialog({
                modal: true,
		resizable:false,
                title: (this.model.isNew() ? 'New' : 'Edit') + ' Event',
                buttons: buttons,
                open: this.open
            });
            return this;
        },        
        open: function() {
            var title = (this.model.get('title')) ? this.model.get('title') : this.model.defaults.title;
            this.$('#title').val(this.model.get('title'));
            var color = (this.model.get('color')) ? this.model.get('color') : this.model.defaults.color;
            },        
        save: function() {
            this.model.set({'title': this.$('#title').val(), 'color': this.$('#color').val()});
            if (this.model.isNew()) {
                this.collection.create(this.model, {success: this.close});
            } else {
                this.model.save({}, {success: this.close});
            }
        },
        close: function() {
            this.el.dialog('close');
        },
        destroy: function() {
            this.model.destroy({success: this.close});
        }        
    });
    new EventsView({el: $("#calendar")});
});
