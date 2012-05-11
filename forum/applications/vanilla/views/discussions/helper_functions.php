<?php if (!defined('APPLICATION')) exit();

function WriteDiscussion($Discussion, &$Sender, &$Session, $Alt2) {
	static $Alt = FALSE;
	$CssClass = 'Item';
	$CssClass .= $Discussion->Bookmarked == '1' ? ' Bookmarked' : '';
	$CssClass .= $Alt ? ' Alt ' : '';
	$Alt = !$Alt;
	$CssClass .= $Discussion->Announce == '1' ? ' Announcement' : '';
	$CssClass .= $Discussion->Dismissed == '1' ? ' Dismissed' : '';
	$CssClass .= $Discussion->InsertUserID == $Session->UserID ? ' Mine' : '';
	$CssClass .= ($Discussion->CountUnreadComments > 0 && $Session->IsValid()) ? ' New' : '';
	$DiscussionUrl = '/discussion/'.$Discussion->DiscussionID.'/'.Gdn_Format::Url($Discussion->Name).($Discussion->CountCommentWatch > 0 && C('Vanilla.Comments.AutoOffset') && $Session->UserID > 0 ? '/#Item_'.$Discussion->CountCommentWatch : '');
	$Sender->EventArguments['DiscussionUrl'] = &$DiscussionUrl;
	$Sender->EventArguments['Discussion'] = &$Discussion;
	$Sender->EventArguments['CssClass'] = &$CssClass;
	$First = UserBuilder($Discussion, 'First');
	$Last = UserBuilder($Discussion, 'Last');
	
	$Sender->FireEvent('BeforeDiscussionName');
	
	$DiscussionName = $Discussion->Name;
	if ($DiscussionName == '')
		$DiscussionName = T('Blank Discussion Topic');
		
	$Sender->EventArguments['DiscussionName'] = &$DiscussionName;

	static $FirstDiscussion = TRUE;
	if (!$FirstDiscussion)
		$Sender->FireEvent('BetweenDiscussion');
	else
		$FirstDiscussion = FALSE;
?>
<li class="<?php echo $CssClass; ?>">
	<?php
	if (!property_exists($Sender, 'CanEditDiscussions'))
		$Sender->CanEditDiscussions = GetValue('PermsDiscussionsEdit', CategoryModel::Categories($Discussion->CategoryID)) && C('Vanilla.AdminCheckboxes.Use');;

	$Sender->FireEvent('BeforeDiscussionContent');

	WriteOptions($Discussion, $Sender, $Session);
	?>
	<div class="ItemContent Discussion">
		<div class="Title"><?php echo Anchor('<i class="icon-comment"></i> '.$DiscussionName, $DiscussionUrl); ?></div>
		<?php $Sender->FireEvent('AfterDiscussionTitle'); ?>
		
		<div class="Meta">
			<?php $Sender->FireEvent('BeforeDiscussionMeta'); ?>
			<?php if ($Discussion->Announce == '1') { ?>
			<span class="Announcement"><?php echo T('Announcement'); ?></span>
			<?php } ?>
			<?php if ($Discussion->Closed == '1') { ?>
			<span class="Closed"><?php echo T('Closed'); ?></span>
			<?php } ?>
			<span class="CommentCount"><i class="icon-comments"></i> <?php printf(Plural($Discussion->CountComments, '%s comment', '%s comments'), $Discussion->CountComments); ?></span>
			<?php
				if ($Session->IsValid() && $Discussion->CountUnreadComments > 0)
					echo '<strong class="HasNew">'.Plural($Discussion->CountUnreadComments, '%s New', '%s New Plural').'</strong>';

				$Sender->FireEvent('AfterCountMeta');

				if ($Discussion->LastCommentID != '') {
					echo '<i class="icon-user"></i> <span class="LastCommentBy">'.sprintf(T('Most recent by %1$s'), UserAnchor($Last)).'</span>';
					echo '<i class="icon-calendar"></i> <span class="LastCommentDate">'.Gdn_Format::Date($Discussion->LastDate).'</span>';
				} else {
					echo '<i class="icon-user"></i> <span class="LastCommentBy">'.sprintf(T('Started by %1$s'), UserAnchor($First)).'</span>';
					echo '<i class="icon-calendar"></i> <span class="LastCommentDate">'.Gdn_Format::Date($Discussion->FirstDate);
					
					if ($Source = GetValue('Source', $Discussion)) {
						echo ' '.sprintf(T('via %s'), T($Source.' Source', $Source));
					}
					
					echo '</span>';
				}
			
				if (C('Vanilla.Categories.Use') && $Discussion->CategoryUrlCode != '')
					echo '<i class="icon-folder-open"></i> ';
					echo Wrap(Anchor($Discussion->Category, '/categories/'.rawurlencode($Discussion->CategoryUrlCode), 'Category'));
				
				$Sender->FireEvent('DiscussionMeta');
				
			?>
		</div>
		
		<a class="SingleExcerptToggle" href="#"><i class="icon-chevron-down"></i></a>
		
		<?php if ( !in_array($Sender->CategoryID, C("Plugins.NillaBlog.CategoryIDs")) ) {
			$Body = $Discussion->Body;
		 	$end = substr($Body, 0);
		 	if ($end)
			 	$Body = substr($Body, 0, 400);
		 	$Discussion->FormatBody = Gdn_Format::To($Body, $Discussion->Format);
		 	?>
			<ul class="MessageList ExcerptList">
				<li>
					<div class="Message Excerpt">
						<?php echo strip_tags($Discussion->FormatBody,'<p><a><code><pre>)'); ?>…
					</div>
				</li>
				<?php if ($end) { ?>
					<li>
						<a href="<?php echo Gdn::Request()->Url(ConcatSep("/", "discussion", $Discussion->DiscussionID, Gdn_Format::Url($Discussion->Name)))?>"
							class="More"><?php echo T("Read more");?></a>
					</li>
				<?php } ?>
			</ul>
		<?php } else if ( C('EnabledPlugins.NillaBlog')) {
		 	echo '<style type="text/css">
			  	 .DiscussionsTabs,.StatBoxes,.SingleExcerptToggle{display:none;}
			 	 body.Discussions ul.DataList div.Options{right:0;}
			 	 .DataList.Discussions{-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;}
					  </style>';
		 	}
		 	?>
		
	</div>
</li>
<?php
}

function WriteFilterTabs(&$Sender) {
	$Session = Gdn::Session();
	$Title = property_exists($Sender, 'Category') ? GetValue('Name', $Sender->Category, '') : '';
	if ($Title == '')
		$Title = T('All Discussions');
		
	$Bookmarked = T('My Bookmarks');
	$MyDiscussions = T('My Discussions');
	$MyDrafts = T('My Drafts');
	$CountBookmarks = 0;
	$CountDiscussions = 0;
	$CountDrafts = 0;
	if ($Session->IsValid()) {
		$CountBookmarks = $Session->User->CountBookmarks;
		$CountDiscussions = $Session->User->CountDiscussions;
		$CountDrafts = $Session->User->CountDrafts;
	}
	if ($CountBookmarks === NULL) {
		$Bookmarked .= '<span class="Popin" rel="'.Url('/discussions/UserBookmarkCount').'">-</span>';
	} elseif (is_numeric($CountBookmarks) && $CountBookmarks > 0)
		$Bookmarked .= '<span>'.$CountBookmarks.'</span>';

	if (is_numeric($CountDiscussions) && $CountDiscussions > 0)
		$MyDiscussions .= '<span>'.$CountDiscussions.'</span>';

	if (is_numeric($CountDrafts) && $CountDrafts > 0)
		$MyDrafts .= '<span>'.$CountDrafts.'</span>';
		
	?>
<div class="Tabs DiscussionsTabs Box">
	<ul class="TabItems">
		<?php $Sender->FireEvent('BeforeDiscussionTabs'); ?>
		<li<?php echo strtolower($Sender->ControllerName) == 'discussionscontroller' && strtolower($Sender->RequestMethod) == 'index' ? ' class="Active"' : ''; ?>><?php echo Anchor(T('All Discussions'), 'discussions', 'TabLink'); ?></li>
		<?php $Sender->FireEvent('AfterAllDiscussionsTab'); ?>

		<?php
		if (C('Vanilla.Categories.ShowTabs')) {
			$CssClass = '';
			if (strtolower($Sender->ControllerName) == 'categoriescontroller' && strtolower($Sender->RequestMethod) == 'all') {
				$CssClass = 'Active';
			}

			echo "<li class=\"$CssClass\">".Anchor(T('Categories'), '/categories/all', 'TabLink').'</li>';
		}
		?>
		<?php if ($CountBookmarks > 0 || $Sender->RequestMethod == 'bookmarked') { ?>
		<li<?php echo $Sender->RequestMethod == 'bookmarked' ? ' class="Active"' : ''; ?>><?php echo Anchor($Bookmarked, '/discussions/bookmarked', 'MyBookmarks TabLink'); ?></li>
		<?php
			$Sender->FireEvent('AfterBookmarksTab');
		}
		if ($CountDiscussions > 0 || $Sender->RequestMethod == 'mine') {
		?>
		<li<?php echo $Sender->RequestMethod == 'mine' ? ' class="Active"' : ''; ?>><?php echo Anchor($MyDiscussions, '/discussions/mine', 'MyDiscussions TabLink'); ?></li>
		<?php
		}
		if ($CountDrafts > 0 || $Sender->ControllerName == 'draftscontroller') {
		?>
		<li<?php echo $Sender->ControllerName == 'draftscontroller' ? ' class="Active"' : ''; ?>><?php echo Anchor($MyDrafts, '/drafts', 'MyDrafts TabLink'); ?></li>
		<?php
		}
		$Sender->FireEvent('AfterDiscussionTabs');
		?>
		<li class="ExcerptLink"><a class="TabLink ExcerptToggle active btn-primary" href="#"><i class="icon-eye-open"></i> Excerpts</a></li>
	</ul>
	<?php
	$Breadcrumbs = Gdn::Controller()->Data('Breadcrumbs');
	if ($Breadcrumbs) {
		echo '<ul class="breadcrumb">';
		$First = TRUE;
		foreach ($Breadcrumbs as $Breadcrumb) {
			if ($First) {
				$First = FALSE;
			} else {
				echo '<span class="divider"> / </span>';
			}
			
			echo '<li>', Anchor(Gdn_Format::Text($Breadcrumb['Name']), $Breadcrumb['Url']), '</li>';
		}
		$Sender->FireEvent('AfterBreadcrumbs');
		echo '<li class="AdminCheck"><input type="checkbox" name="Toggle" /></li></ul>';
	}
	if (!property_exists($Sender, 'CanEditDiscussions'))
		$Sender->CanEditDiscussions = $Session->CheckPermission('Vanilla.Discussions.Edit', TRUE, 'Category', 'any') && C('Vanilla.AdminCheckboxes.Use');
	
	if ($Sender->CanEditDiscussions) {
	?>
	<?php } ?>
</div>
	<?php
}

/**
 * Render options that the user has for this discussion.
 */
function WriteOptions($Discussion, &$Sender, &$Session) {
	if ($Session->IsValid() && $Sender->ShowOptions) {
		echo '<div class="Options">';
		$Sender->Options = '';
		
		// Dismiss an announcement
		if (C('Vanilla.Discussions.Dismiss', 1) && $Discussion->Announce == '1' && $Discussion->Dismissed != '1')
			$Sender->Options .= '<li>'.Anchor(T('Dismiss'), 'vanilla/discussion/dismissannouncement/'.$Discussion->DiscussionID.'/'.$Session->TransientKey(), 'DismissAnnouncement') . '</li>';
		
		// Edit discussion
		if ($Discussion->FirstUserID == $Session->UserID || $Session->CheckPermission('Vanilla.Discussions.Edit', TRUE, 'Category', $Discussion->PermissionCategoryID))
			$Sender->Options .= '<li>'.Anchor(T('Edit'), 'vanilla/post/editdiscussion/'.$Discussion->DiscussionID, 'EditDiscussion') . '</li>';

		// Announce discussion
		if ($Session->CheckPermission('Vanilla.Discussions.Announce', TRUE, 'Category', $Discussion->PermissionCategoryID))
			$Sender->Options .= '<li>'.Anchor(T($Discussion->Announce == '1' ? 'Unannounce' : 'Announce'), 'vanilla/discussion/announce/'.$Discussion->DiscussionID.'/'.$Session->TransientKey().'?Target='.urlencode($Sender->SelfUrl), 'AnnounceDiscussion') . '</li>';

		// Sink discussion
		if ($Session->CheckPermission('Vanilla.Discussions.Sink', TRUE, 'Category', $Discussion->PermissionCategoryID))
			$Sender->Options .= '<li>'.Anchor(T($Discussion->Sink == '1' ? 'Unsink' : 'Sink'), 'vanilla/discussion/sink/'.$Discussion->DiscussionID.'/'.$Session->TransientKey().'?Target='.urlencode($Sender->SelfUrl), 'SinkDiscussion') . '</li>';

		// Close discussion
		if ($Session->CheckPermission('Vanilla.Discussions.Close', TRUE, 'Category', $Discussion->PermissionCategoryID))
			$Sender->Options .= '<li>'.Anchor(T($Discussion->Closed == '1' ? 'Reopen' : 'Close'), 'vanilla/discussion/close/'.$Discussion->DiscussionID.'/'.$Session->TransientKey().'?Target='.urlencode($Sender->SelfUrl), 'CloseDiscussion') . '</li>';
		
		// Delete discussion
		if ($Session->CheckPermission('Vanilla.Discussions.Delete', TRUE, 'Category', $Discussion->PermissionCategoryID))
			$Sender->Options .= '<li>'.Anchor(T('Delete'), 'vanilla/discussion/delete/'.$Discussion->DiscussionID.'/'.$Session->TransientKey().'?Target='.urlencode($Sender->SelfUrl), 'DeleteDiscussion') . '</li>';
		
		// Allow plugins to add options
		$Sender->FireEvent('DiscussionOptions');
		
		if ($Sender->Options != '') {
		?>
			<!-- <div class="ToggleFlyout OptionsMenu">
				<div class="MenuTitle"><i class="icon-cog"></i> <?php echo T('Options'); ?></div>
				<ul class="Flyout MenuItems">
					<?php echo $Sender->Options; ?>
				</ul>
			</div> -->
			<div class="btn-group OptionsMenu">
			<a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="icon-cog"></i>
				<span class="caret"></span>
			</a>
  			<ul class="dropdown-menu pull-right">
				<?php echo $Sender->Options; ?>
			</ul>
		</div>
		<?php
		}
		// Admin check.
		if ($Sender->CanEditDiscussions) {
			if (!property_exists($Sender, 'CheckedDiscussions')) {
				$Sender->CheckedDiscussions = (array)$Session->GetAttribute('CheckedDiscussions', array());
				if (!is_array($Sender->CheckedDiscussions))
					$Sender->CheckedDiscussions = array();
			}

			$ItemSelected = in_array($Discussion->DiscussionID, $Sender->CheckedDiscussions);
			echo '<span class="AdminCheck"><input type="checkbox" name="DiscussionID[]" value="'.$Discussion->DiscussionID.'"'.($ItemSelected?' checked="checked"':'').' /></span>';
		}

		// Bookmark link
		$Title = T($Discussion->Bookmarked == '1' ? 'Unbookmark' : 'Bookmark');
		echo Anchor(
			'<i class="icon-star-empty"></i>',
			'/vanilla/discussion/bookmark/'.$Discussion->DiscussionID.'/'.$Session->TransientKey().'?Target='.urlencode($Sender->SelfUrl),
			'Bookmark' . ($Discussion->Bookmarked == '1' ? ' Bookmarked' : ''),
			array('title' => $Title)
		);
		
		echo '</div>';
	}
	
	echo '<div class="StatBoxes">';
		
		$Session = Gdn::Session();
		$Discussion = GetValue('Discussion', $Sender->EventArguments);
		
		// Views
		echo Wrap(
			// Anchor(
			Wrap('<div class="StatsLabel">' . T('Views')) . '</div><div class="StatsNumber">' . Gdn_Format::BigNumber($Discussion->CountViews) . '</div>'
			// , '/discussion/'.$Discussion->DiscussionID.'/'.Gdn_Format::Url($Discussion->Name).($Discussion->CountCommentWatch > 0 ? '/#Item_'.$Discussion->CountCommentWatch : '')
			// )
			, 'div', array('class' => 'StatBox ViewsBox')
		);
		
		// Comments
		$Css = 'StatBox CommentsBox';
		if ($Discussion->CountComments > 1)
			$Css .= ' HasComments';
			
		$CountVotes = 0;
		if (is_numeric($Discussion->Score)) // && $Discussion->Score > 0)
			$CountVotes = $Discussion->Score;
			
		if (!is_numeric($Discussion->CountBookmarks))
			$Discussion->CountBookmarks = 0;
		
		echo Wrap(
			// Anchor(
			Wrap('<div class="StatsLabel">' . T('Comments')) . '</div><div class="StatsNumber">' . Gdn_Format::BigNumber($Discussion->CountComments) . '</div>'
			// ,'/discussion/'.$Discussion->DiscussionID.'/'.Gdn_Format::Url($Discussion->Name).($Discussion->CountCommentWatch > 0 ? '/#Item_'.$Discussion->CountCommentWatch : '')
			// )
			, 'div', array('class' => $Css));
		
		echo '</div>';
}