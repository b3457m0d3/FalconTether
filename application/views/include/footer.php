  <hr>

      <footer>
        <p>&copy; <i class="icon-exclamation-sign"></i><i class="icon-question-sign"></i>Netw<i class="icon-off"></i>rk 2012</p>
      </footer>
      <?php if(isset($markitup)){ ?>
      <div id="dialog-confirm" title="Really Giving Up?">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>There is no "Undo" for this.</p>
      </div>
    </div> <!-- /container -->
   <!-- markItUp! -->
<script type="text/javascript" src="/assets/js/markitup/jquery.markitup.js"></script>
<!-- markItUp! toolbar settings -->
<script type="text/javascript" src="/assets/js/markitup/sets/default/set.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#toggle').click(function() { $('#advanced').slideToggle('slow', function() {}); });
        $('.fadeOut').click(function() { $('.fadeOut').fadeOut('slow', function() {}); });
        $('.markitup').markItUp(mySettings);
        $('#newProject').click(function() {
        $('#addProject').slideToggle('slow', function() {}); });
        var currentForm;
        $("#dialog-confirm").dialog({
            resizable: false,
            height: 140,
            modal: true,
            autoOpen: false,
            buttons: {
                'Delete all items': function() {
                    $(this).dialog('close');
                    currentForm.submit();
                },
                'Cancel': function() {
                    $(this).dialog('close');
                }
            }
        });
        $(".delete").click(function() {
          currentForm = $(this).closest('form');
          $("#dialog-confirm").dialog('open');
          return false;
        });
        
        <?php
          if(isset($countdown)) $this->load->view('countdown',$countdown);
        ?>
    });

    </script>
    <?php } ?>

    
</body>
</html>
