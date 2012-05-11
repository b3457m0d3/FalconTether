window.apps.views.main.events = Backbone.View.extend({
			el: $("#calendar"),
			_construct: function(){
				_.bindAll(this);
				//collection binding
				this.collection = new window.apps.collections.events();
				this.collection.bind('reset', this.addAll);
				this.collection.bind('add', this.addOne);
				this.collection.bind('change', this.change);            
				this.collection.bind('destroy', this.destroy);
				this.collection.fetch();
				
				this.eventView = new window.apps.views.dlgs.event();
				
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
				this.eventView.model = new window.apps.models.event({start: startDate, end: endDate});
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


