<?php /* Smarty version 2.6.26, created on 2012-05-10 06:56:23
         compiled from /home/bo0m3r/public_html/falcontether.cc/tracking/plugins/Dashboard/templates/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadJavascriptTranslations', '/home/bo0m3r/public_html/falcontether.cc/tracking/plugins/Dashboard/templates/index.tpl', 1, false),array('modifier', 'translate', '/home/bo0m3r/public_html/falcontether.cc/tracking/plugins/Dashboard/templates/index.tpl', 98, false),)), $this); ?>
<?php echo smarty_function_loadJavascriptTranslations(array('plugins' => 'CoreHome Dashboard'), $this);?>


<script type="text/javascript">
    piwik.dashboardLayout = <?php echo $this->_tpl_vars['layout']; ?>
;
    piwik.idDashboard     = <?php echo $this->_tpl_vars['dashboardId']; ?>
;
    </script>

<?php echo '
<script type="text/javascript">
$(document).ready( function() {
    // Standard dashboard
    if($(\'#periodString\').length) 
    {
        $(\'#periodString\').after($(\'#dashboardSettings\'));
        $(\'#dashboardSettings\').css({left:$(\'#periodString\')[0].offsetWidth+10});
    }
    // Embed dashboard
    else 
    {
        $(\'#dashboardSettings\').css({left:7, top:10});
    }

    $(\'#dashboardSettings\').on(\'click\', function(){
        $(\'#dashboardSettings\').toggleClass(\'visible\');
        // fix position
        $(\'#dashboardSettings .widgetpreview-widgetlist\').css(\'paddingTop\', $(\'#dashboardSettings .widgetpreview-categorylist\').parent(\'li\').position().top);
    });
    $(\'body\').on(\'mouseup\', function(e) {
        if(!$(e.target).parents(\'#dashboardSettings\').length && !$(e.target).is(\'#dashboardSettings\')) {
            $(\'#dashboardSettings\').widgetPreview(\'reset\');
            $(\'#dashboardSettings\').removeClass(\'visible\');
        }
    });
    
    piwik.dashboardObject = new dashboard();
    piwik.dashboardObject.init(piwik.dashboardLayout);

    $(\'#dashboardSettings\').widgetPreview({
        isWidgetAvailable: function(widgetUniqueId) {
            if($(\'#\'+widgetUniqueId, piwik.dashboardObject.dashboardElement).length) {
                return false;
            } else {
                return true;
            }
        },
        onSelect: function(widgetUniqueId) {
            var newDashboardWidget = piwik.dashboardObject.addEmptyWidget(0, widgetUniqueId, true);
            $(\'.widgetContent\', newDashboardWidget).replaceWith(
                $(\'#dashboardSettings .widgetpreview-preview .widgetContent\')
            );
            $(\'#dashboardSettings\').removeClass(\'visible\');
            piwik.dashboardObject.makeSortable();
            piwik.dashboardObject.saveLayout();
        },
        resetOnSelect: true
    });

    $(\'#columnPreview>div\').each(function(){
        var width = new Array();
        $(\'div\', this).each(function(){
            width.push(this.className.replace(/width-/, \'\'));
        })
        $(this).attr(\'layout\', width.join(\'-\'));
    });

    $(\'#columnPreview>div\').on(\'click\', function(){
        $(\'#columnPreview>div\').removeClass(\'choosen\');
        $(this).addClass(\'choosen\');
    });

    $(\'.submenu>li\').on(\'mouseenter\', function(event){
        if(!$(\'.widgetpreview-categorylist\', event.target).length) {
            $(\'#dashboardSettings\').widgetPreview(\'reset\');
        }
    });
});

function resetDashboard() {
    piwikHelper.windowModal(\'#resetDashboardConfirm\', function(){ piwik.dashboardObject.resetLayout(); })
}

function showChangeDashboardLayoutDialog() {
    $(\'#columnPreview>div[layout=\'+piwik.dashboardObject.currentColumnLayout+\']\').addClass(\'choosen\');
    piwikHelper.windowModal(\'#changeDashboardLayout\', function(){
        piwik.dashboardObject.adjustDashboardColumns($(\'#changeDashboardLayout .choosen\').attr(\'layout\'));
    });
}

</script>
'; ?>

<div id="dashboard">
 
    <div class="ui-confirm" id="confirm">
        <h2><?php echo ((is_array($_tmp='Dashboard_DeleteWidgetConfirm')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
        <input id="yes" type="button" value="<?php echo ((is_array($_tmp='General_Yes')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" />
        <input id="no" type="button" value="<?php echo ((is_array($_tmp='General_No')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" />
    </div> 
    
    <div class="ui-confirm" id="resetDashboardConfirm">
        <h2><?php echo ((is_array($_tmp='Dashboard_ResetDashboardConfirm')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
        <input id="yes" type="button" value="<?php echo ((is_array($_tmp='General_Yes')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" />
        <input id="no" type="button" value="<?php echo ((is_array($_tmp='General_No')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" />
    </div> 
    
    <div class="ui-confirm" id="changeDashboardLayout">
        <h2><?php echo ((is_array($_tmp='Dashboard_SelectDashboardLayout')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
        <div id="columnPreview">
        <?php $_from = $this->_tpl_vars['availableLayouts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['layout']):
?>
            <div>
            <?php $_from = $this->_tpl_vars['layout']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['column']):
?>
                 <div class="width-<?php echo $this->_tpl_vars['column']; ?>
"><span></span></div>
            <?php endforeach; endif; unset($_from); ?>
            </div>
        <?php endforeach; endif; unset($_from); ?>
        </div>
        <input id="yes" type="button" value="<?php echo ((is_array($_tmp='General_Save')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" />
    </div> 
    
    <div id="dashboardSettings">
        <span><?php echo ((is_array($_tmp='Dashboard_WidgetsAndDashboard')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span>
        <ul class="submenu">
            <li>
                <div id='addWidget'><?php echo ((is_array($_tmp='Dashboard_AddAWidget')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 &darr;</div>
                <ul class="widgetpreview-categorylist"></ul>
            </li>
            <li onclick="resetDashboard();"><?php echo ((is_array($_tmp='Dashboard_ResetDashboard')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</li>
            <li onclick="showChangeDashboardLayoutDialog();"><?php echo ((is_array($_tmp='Dashboard_ChangeDashboardLayout')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</li>
        </ul>
        <ul class="widgetpreview-widgetlist"></ul>
        <div class="widgetpreview-preview"></div>
    </div>
    
    <div class="clear"></div>
    
    <div id="dashboardWidgetsArea"></div>
</div>