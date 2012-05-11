<?php if (!defined('APPLICATION')) exit();
$Session = Gdn::Session();
$NewOrDraft = !isset($this->Comment) || property_exists($this->Comment, 'DraftID') ? TRUE : FALSE;
$Editing = isset($this->Comment);
?>
<div class="MessageForm CommentForm">
   <?php if (!$Editing) { ?>
   <label>New comment</label>
   <?php
   } else {
      $this->Form->SetFormValue('Body', $this->Comment->Body);
   }
   echo $this->Form->Open();
   echo $this->Form->Errors();
   
   $CommentOptions = array('MultiLine' => TRUE);
   /*
    Caused non-root users to not be able to add comments. Must take categories
    into account. Look at CheckPermission for more information.
   if (!$Session->CheckPermission('Vanilla.Comment.Add')) {
      $CommentOptions['Disabled'] = 'disabled';
      $CommentOptions['Value'] = T('You do not have permission to write new comments.');
   }
   */
   $this->FireEvent('BeforeBodyField');
   echo Wrap($this->Form->TextBox('Body', $CommentOptions), 'div', array('class' => 'TextBoxWrapper'));
   $this->FireEvent('AfterBodyField');
   echo "<div class=\"Buttons\">\n";
   $this->FireEvent('BeforeFormButtons');
   $CancelText = T('Back to Discussions');
   $CancelClass = 'Back';
   if (!$NewOrDraft) {
      $CancelText = T('Cancel');
      $CancelClass = 'Cancel';
   }

   /*echo Gdn_Theme::Link('forumroot', $CancelText, NULL, array(
       'class' => $CancelClass
   ));*/
   
   $ButtonOptions = array('class' => 'Button CommentButton');
   /*
    Caused non-root users to not be able to add comments. Must take categories
    into account. Look at CheckPermission for more information.
   if (!Gdn::Session()->CheckPermission('Vanilla.Comment.Add'))
      $ButtonOptions['Disabled'] = 'disabled';
   */
   
   if (!$Editing) { ?>
   <div class="Tabs CommentTabs">
		<ul>
			<li><?php echo Anchor(T('Write Comment'), '#', 'WriteButton btn'); ?></li>
			<?php
			if (!$Editing)
				echo '<li>'.Anchor(T('Preview'), '#', 'PreviewButton btn btn-info')."</li>\n";
			
			if ($NewOrDraft)
				echo '<li>'.Anchor(T('Save Draft'), '#', 'DraftButton btn btn-primary')."</li>\n";
	
			$this->FireEvent('AfterCommentTabs');
			?>
		</ul>
	</div>
   <?php
   }
   if (C('EnabledPlugins.ButtonBar') && !$Editing)
		echo '<script type="text/javascript">jQuery(window).load(function(){jQuery(".Buttons span").replaceWith(jQuery("<span>" + jQuery(".ButtonBarMarkupHint").html() + "</span>"));});</script>';
	if (C('Garden.InputFormatter') == 'Markdown' && !$Editing)
		echo '<span>You can use <b><a href="http://en.wikipedia.org/wiki/Markdown">Markdown</a></b> in your post</span>';
	if (C('Garden.InputFormatter') == 'BBCode' && !$Editing)
		echo '<span>You can use <b><a href="http://en.wikipedia.org/wiki/BBCode">BBCode</a></b> in your post</span>';
	if (C('Garden.InputFormatter') == 'Html' && !$Editing)
		echo '<span>You can use <b><a href="http://htmlguide.drgrog.com/cheatsheet.php">Simple Html</a></b> in your post</span>';
   echo $this->Form->Button($Editing ? 'Save Comment' : 'Post Comment', $ButtonOptions);
   $this->FireEvent('AfterFormButtons');
   echo "</div>\n";
   echo $this->Form->Close();
   ?>
</div>