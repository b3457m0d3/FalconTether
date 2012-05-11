<?php if (!defined('APPLICATION')) exit();
// An individual discussion record for all panel modules to use when rendering a discussion list.
?>
<li id="<?php echo 'Bookmark_'.$Discussion->DiscussionID; ?>">
	<strong><?php
		echo Anchor('<i class="icon-pushpin"></i> '.Gdn_Format::Text($Discussion->Name, FALSE), '/discussion/'.$Discussion->DiscussionID.'/'.Gdn_Format::Url($Discussion->Name).($Discussion->CountCommentWatch > 0 ? '/#Item_'.$Discussion->CountCommentWatch : ''), 'DiscussionLink');
	?></strong>
	<div class="Meta">
		<?php
			if ($Discussion->CountComments == 1) { $CommentLabel = 'comment'; } else { $CommentLabel = 'comments'; }	
			echo '<span class="label label-info">'.$Discussion->CountComments.' '.T($CommentLabel).'</span>';
			
			if ($Discussion->CountUnreadComments > 0 || $Discussion->CountUnreadComments === '')
				echo '<strong>'.Plural($Discussion->CountUnreadComments, '%s new', '%s new').'</strong>';
				
			$Last = new stdClass();
			$Last->UserID = $Discussion->LastUserID;
			$Last->Name = $Discussion->LastName;
			if ($Discussion->CountComments > 1) echo '<span> '.T('Lastest comment at').' '.Gdn_Format::Date($Discussion->LastDate).' '.Gdn_format::Text(T('by')).' '.UserAnchor($Last).'</span>';
			if ($Discussion->CountComments <= 1) echo T('No other comments have been posted yet');
		?>
	</div>
</li>
