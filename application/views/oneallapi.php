<?php
 
  //Your Site Settings
  $site_subdomain = 'iebcc';
  $site_public_key = '61dd58d4-6eed-4dc9-9690-51a14879312f';
  $site_private_key = '1a5f4ba1-b80f-4ad7-9319-43a5f1b783f8';
 
  //API Access Domain
  $site_domain = $site_subdomain.'.api.oneall.com';
 
  //Connection Resource
  $resource_uri = 'https://'.$site_domain.'/connections/'.$token .'.json';
 
  //Setup connection
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $resource_uri);
  curl_setopt($curl, CURLOPT_HEADER, 0);
  curl_setopt($curl, CURLOPT_USERPWD, $site_public_key . ":" . $site_private_key);
  curl_setopt($curl, CURLOPT_TIMEOUT, 15);
  curl_setopt($curl, CURLOPT_VERBOSE, 0);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
  curl_setopt($curl, CURLOPT_FAILONERROR, 0);
 
  //Send request
  $result_json = curl_exec($curl);
  curl_close($curl);
   
  //Done
  print_r($result_json);
   
?>