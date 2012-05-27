  <div id="dialog-confirm" title="Really Giving Up?">
	<i class="icon-warning-sign" style="font-color:#ff000"></i>There is no "Undo" for this.
  </div>
    <!-- Le javascript================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/js/bootstrapmin.js"></script>
    <script src="/assets/js/dialog_confirm.js"></script>
    <script src="/assets/js/humane.min.js"></script>
    <script src="/assets/js/sisyphus.js"></script>
    <script src="/assets/js/charCount.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      <?php if(isset($script)) echo $script;   ?>
      var notify = humane.create({ timeout: 4000, baseCls: 'humane-libnotify', addnCls: 'humane-libnotify-info' })
      $('form').sisyphus({timeout: 25,onSave: function() {notify.log('Draft Saved')}});
      $("#mission").charCount({ allowed: 2000,	warning: 20 });
      });
    </script>
  </body>
</html>
