jQuery(window).load(function() {

//Change classes to match those of Bootstrap

	//Buttons
	jQuery('.TabLink').toggleClass('TabLink btn');
	jQuery('.Button').toggleClass('Button btn');
	jQuery('.BigButton').toggleClass('BigButton btn btn-primary');
	jQuery('.More').toggleClass('btn btn-mini');
	jQuery('#Form_SaveDraft').toggleClass('btn-info');
	jQuery('#Form_Preview').toggleClass('btn-primary');

	//Labels
	jQuery('span.Tag').toggleClass('Tag label label-default');
	jQuery('span.Announcement').toggleClass('Announcement label label-info');
	jQuery('span.Closed').toggleClass('Closed label label-important');
	jQuery('.tab-items span').toggleClass('label label-info');
	
	//Headers and tabs
	jQuery('.ProfileTabs ul').toggleClass('breadcrumb');
	
	//Error message
	jQuery('.Errors ul').each(function() {
		jQuery(this).replaceWith(jQuery('<span class="btn btn-danger">' + jQuery(this).text() + '</span>'));
	});
	
	//Pagination
	jQuery('.Pager').toggleClass('pagination').wrapInner('<ul/>');
	jQuery('.Pager ul').children().wrap('<li/>');
	jQuery('.Pager li').each(function() {
		if (jQuery(this).find('a').hasClass('Highlight')) {
			jQuery(this).toggleClass('active');
		};
	});
	
	//Bugs
	jQuery('body').removeClass('thumbnail');
	
	//Plugin compatibility
	
		//QnA
		jQuery('.NewQuestion').toggleClass('btn-primary btn-info');
		jQuery('span.QnA-Tag-Question').toggleClass('QnA-Tag-Question label-default label-warning');
		jQuery('span.QnA-Tag-Accepted').toggleClass('QnA-Tag-Accepted label-default label-success');
		jQuery('span.QnA-Accepted').replaceWith('<div class="QnA-Accepted"><i class="icon-ok-sign"></i></div>');
		
		//Tagging Enhanced
		jQuery('.TaggedHeading').toggleClass('breadcrumb');
		jQuery('.Tags .PanelInfo li').contents().filter(function() {
			return this.nodeType == Node.TEXT_NODE;
		}).wrap('<span class="Count"/>');
		
		//Kudos
		jQuery('.Kudos a:first-child').contents().replaceWith('<i class="icon-thumbs-up"></i>');
		jQuery('.Kudos a:last-child').contents().replaceWith('<i class="icon-thumbs-down"></i>');
	
});