(function(){
//sets of commonly used scripts with dependencies
	var jquery = ['jquery-1.5.1.min.js','https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js'];
	var backbone = ['underscore.js','backbone.js'];
	var plans = ['miniColors.js','fullCalendar.js','application.js'];
	
//Namespacing	
	window.apps = {};
	window.apps.models = {};
	window.apps.collections = {};
	window.apps.views = {};
	window.apps.views.main = {};

	$LAB.setGlobalDefaults({
		AlwaysPreserveOrder:true,
		BasePath: 'http://www.tarantism.us/assets/js/'
	});

	$LAB.script(jquery,backbone,plans)	

})();
