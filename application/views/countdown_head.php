<style type="text/css">
      br { clear: both; }
      .cntSeparator {
        font-size: 54px;
        margin: 10px 7px;
        color: #000;
      }
      .desc { margin: 7px 3px; }
      .desc div {
        float: left;
        font-family: Arial;
        width: 70px;
        margin-right: 65px;
        font-size: 13px;
        font-weight: bold;
        color: #000;
      }
    </style>
<?php
$time = $this->uri->segment(3);
if(!$time) $time = "01:12:12:00";
?>
<script src="/assets/js/jquery.countdown.js"></script>

<script type="text/javascript">
$(function(){
$('#counter').countdown({
  image: '/assets/img/digits.png',
  startTime: '<?=$time?>'
});
});
</script>