<?php if (!defined('APPLICATION')) exit();
$Methods = $this->Data('Methods', array());
$SelectedMethod = $this->Data('SelectedMethod', array());
$CssClass = count($Methods) > 0 ? ' MultipleEntryMethods' : ' SingleEntryMethod';

// Testing
//$Methods['Facebook'] = array('Label' => 'Facebook', 'Url' => '#', 'ViewLocation' => 'signin');
//$Methods['Twitter'] = array('Label' => 'Twitter', 'Url' => '#', 'ViewLocation' => 'signin');

echo '<div class="Entry'.$CssClass.'">';

	echo $this->Form->Errors();

	// Render the main signin form.
	echo '<div class="MainForm">';
	
	include $this->FetchViewLocation('passwordform');

	echo $this->Data('MainForm');
	
	echo '</div>';

echo '</div>';
