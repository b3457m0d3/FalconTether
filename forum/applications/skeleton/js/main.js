jQuery(window).load(function() {
	
//Show content on load

jQuery('.container-fluid').show();

//Add 'active' class to 'Active' tabs

jQuery('li').each(function() {
	var tabitem = jQuery(this).find('a');
	
	if (jQuery(this).hasClass('Active')) {
		jQuery(tabitem).addClass('active');
	};
});

//Menu highlight
//jQuery('ul.nav a').each(function() {
//	if (window.location.href.indexOf(this.href) >= 0) {
//		jQuery(this).parent().addClass('active');
//	};
//});

//Change folder status of categories

jQuery('.PanelCategories li').each(function() {
	var folder = jQuery(this).find('i');
	
	if (jQuery(this).hasClass('Active')) {
		jQuery(folder).toggleClass('icon-folder-open icon-folder-close');
	};
});
	
//Avoid propagation on login dropdown

jQuery('.login-dropdown').find('form').click(function (e) {
	e.stopPropagation();
});

//Remove panel on system and custom pages

jQuery('body#dashboard_entry_index .span4').remove();
jQuery('body#dashboard_entry_index .span8').toggleClass('span8 span12');

jQuery('body#dashboard_entry_register .span4').remove();
jQuery('body#dashboard_entry_register .span8').toggleClass('span8 span12');

jQuery('body#dashboard_entry_password .span4').remove();
jQuery('body#dashboard_entry_password .span8').toggleClass('span8 span12');

jQuery('body#dashboard_entry_passwordrequest .span4').remove();
jQuery('body#dashboard_entry_passwordrequest .span8').toggleClass('span8 span12');

jQuery('body#dashboard_entry_signin .span4').remove();
jQuery('body#dashboard_entry_signin .span8').toggleClass('span8 span12');

jQuery('body#dashboard_entry_signout .span4').remove();
jQuery('body#dashboard_entry_signout .span8').toggleClass('span8 span12');

jQuery('body#dashboard_plugin_page .span4').remove();
jQuery('body#dashboard_plugin_page .span8').toggleClass('span8 span12');

//Remove panel on certain profile pages

//jQuery('body#dashboard_profile_index .PanelInfo').parent().remove();
//jQuery('body#dashboard_profile_notifications .PanelInfo').parent().remove();
//jQuery('body#dashboard_profile_activity .PanelInfo').parent().remove();
//jQuery('body#dashboard_profile_discussions .PanelInfo').parent().remove();
//jQuery('body#dashboard_profile_comments .PanelInfo').parent().remove();

//Bookmarks

jQuery('.Bookmark').each(function() {
	var bookmark = jQuery(this).find('i');
	
	if (jQuery(this).hasClass('Bookmarked')) {
		jQuery(bookmark).toggleClass('icon-star-empty icon-star');
	}
	
	jQuery(this).click(function() {
		jQuery(bookmark).toggleClass('icon-star-empty icon-star');
	});
});

});

//Remember excerpt toggle choice

jQuery(window).load(function() {
	var panel = jQuery('.ExcerptList');
	var button = jQuery('.ExcerptToggle');
	var icon = jQuery('.ExcerptToggle i');
	var eye = 'icon-eye-open icon-eye-close';
	var initialState = 'expanded'
	var activeClass = 'active';

	if(jQuery.cookie('panelState') == undefined) {
		jQuery.cookie('panelState', initialState, { path: '/' });
	}
	var state = jQuery.cookie('panelState');
	if(state == 'collapsed') {
		panel.hide();
		button.toggleClass(activeClass);
		icon.toggleClass(eye);
	}
	button.click(function(){
		if(jQuery.cookie('panelState') == 'expanded') {
			jQuery.cookie('panelState', 'collapsed', { path: '/' });
			button.toggleClass(activeClass);
			icon.toggleClass(eye);
			panel.slideUp('fast');
		} else {
			jQuery.cookie('panelState', 'expanded', { path: '/' });
			button.toggleClass(activeClass);
			icon.toggleClass(eye);
			panel.slideDown('fast');
		}
		return false;
	});
	
	//Toggle individual excerpts
	
	jQuery('.DataList li.Item').each(function() {
		var toggle = jQuery(this).find('.SingleExcerptToggle');
		var excerpt = jQuery(this).find('.ExcerptList');
		var icon = jQuery(this).find('.SingleExcerptToggle i');
		var eye = 'icon-eye-open icon-eye-close';
		var up = 'icon-chevron-up';
		var down = 'icon-chevron-down';
		var chevron = 'icon-chevron-down icon-chevron-up';
		
		toggle.click(function() {
			excerpt.slideToggle('fast');
		});
	
	});
	
});