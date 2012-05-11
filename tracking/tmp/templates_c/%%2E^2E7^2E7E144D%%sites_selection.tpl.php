<?php /* Smarty version 2.6.26, created on 2012-05-10 06:56:18
         compiled from CoreHome/templates/sites_selection.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'CoreHome/templates/sites_selection.tpl', 2, false),)), $this); ?>
<div class="sites_autocomplete">
    <label><?php echo ((is_array($_tmp='General_Website')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>
    <div id="sitesSelectionSearch" class="custom_select">
    
        <a href="index.php?module=CoreHome&amp;action=index&amp;idSite=<?php echo $this->_tpl_vars['idSite']; ?>
&amp;period=<?php echo $this->_tpl_vars['period']; ?>
&amp;date=<?php echo $this->_tpl_vars['rawDate']; ?>
" onclick="return false" class="custom_select_main_link"><?php echo $this->_tpl_vars['siteName']; ?>
</a>
        
        <div class="custom_select_block">
            <div id="custom_select_container">
            <ul class="custom_select_ul_list" >
                <?php $_from = $this->_tpl_vars['sites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['info']):
?>
                    <li <?php if ($this->_tpl_vars['idSite'] == $this->_tpl_vars['info']['idsite']): ?> style="display: none"<?php endif; ?>><a href="index.php?module=CoreHome&amp;action=index&amp;idSite=<?php echo $this->_tpl_vars['info']['idsite']; ?>
&amp;period=<?php echo $this->_tpl_vars['period']; ?>
&amp;date=<?php echo $this->_tpl_vars['rawDate']; ?>
" siteid="<?php echo $this->_tpl_vars['info']['idsite']; ?>
" onclick="switchSite(<?php echo $this->_tpl_vars['info']['idsite']; ?>
, $(this).text());"><?php echo $this->_tpl_vars['info']['name']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
            </ul>
            </div>
            <div class="custom_select_all" style="clear: both">
				<br />
				<a href="index.php?module=MultiSites&amp;action=index&amp;period=<?php echo $this->_tpl_vars['period']; ?>
&amp;date=<?php echo $this->_tpl_vars['rawDate']; ?>
&amp;idSite=<?php echo $this->_tpl_vars['idSite']; ?>
"><?php echo ((is_array($_tmp='General_MultiSitesSummary')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</a>
			</div>
            
            <div class="custom_select_search">
                <input type="text" length="15" id="websiteSearch" class="inp">
                <input type="hidden" class="max_sitename_width" id="max_sitename_width" value="130" />
                <input type="submit" value="Search" class="but">
				<img title="Clear" id="reset" style="position: relative; top: 4px; left: -44px; cursor: pointer; display: none;" src="plugins/CoreHome/templates/images/reset_search.png"/>
            </div>
        </div>
	</div>
    
	<script type="text/javascript">
    <?php if (! $this->_tpl_vars['show_autocompleter']): ?><?php echo '
    $(\'.custom_select_search\').hide();
    '; ?>
<?php endif; ?>
	<?php echo '
    if($(\'.custom_select_ul_list li\').length > 1) {
        $("#sitesSelectionSearch .custom_select_main_link").click(function(){
    		$("#sitesSelectionSearch .custom_select_block").toggleClass("custom_select_block_show");
    		$(\'#websiteSearch\').focus();
    		return false;
    	});
        $(\'#sitesSelectionSearch .custom_select_block\').on(\'mouseenter\', function(){
            $(\'.custom_select_ul_list li a\').each(function(){
                var hash = broadcast.getHashFromUrl();
                $(this).attr(\'href\', piwikHelper.getCurrentQueryStringWithParametersModified(\'idSite=\'+$(this).attr(\'siteid\')) + 
                						(hash 
                						? hash.replace(/idSite=[0-9]+/, \'idSite=\'+$(this).attr(\'siteid\')) 
                						: "")
                );
            });
        });
        var inlinePaddingWidth=22;
        var staticPaddingWidth=34;
        if($(".custom_select_block ul")[0]){
            var widthSitesSelection = Math.max($(".custom_select_block ul").width()+inlinePaddingWidth, $(".custom_select_main_link").width()+staticPaddingWidth);
            $(".custom_select_block").css(\'width\', widthSitesSelection);
        }
    } else {
        $(\'.custom_select_main_link\').addClass(\'noselect\');
    }
    '; ?>

    </script>
</div>
