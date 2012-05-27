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
if($this->uri->segment(3)) $time = $this->uri->segment(3);
else $time = "2012-09-22";
$_seconds = strtotime($time)-time();
$days = round($_seconds / 86400);
if($days<10) $days = "0".$days;
$hours = round(($_seconds % 86400) / 3600);
if($hours<10) $hours = "0".$hours;
$minutes = round((($_seconds % 86400) % 3600) / 60);
if($minutes<10) $minutes = "0".$minutes;
$until = $days.":".$hours.":".$minutes.":00";
?>
<script src="/assets/js/jquery.countdown.js"></script>
<script type="text/javascript">

$(function(){
      $('#counter').countdown({
        image: 'http://www.falcontether.cc/assets/img/digits.png',
        startTime: '<?php echo $until; ?>'
      });
});
</script>