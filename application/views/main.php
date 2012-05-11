<div id="content">
 <div id="content_cen">
  <div id="content_sup">
   <div id="welcom_pan">
    <h2><span>AdipA</span>Coming Soon...</h2>
    <p></p>
   </div>
  </div>
 </div>
</div>

<?php
/* Hits table has an auto-incrementing id and an ip field */

// Grab client IP
$ip = $_SERVER['REMOTE_ADDR'];

// Check for previous visits
$query = $this->db->get_where('hits', array('ip' => $ip), 1, 0);

if ( $query->num_rows() < 1 )
{
    // Never visited - add
    $this->db->insert('hits', array('ip' => $ip) );
}  

?>