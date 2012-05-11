<?php

if(!$user){
        if(!empty($this->ezauth->user)){
                $user = $this->ezauth->user->id;			
        } 
}
$this->rest->initialize(array('server' => 'https://xboxapi.com/json/'));
$query = $this->db->get_where('authentications',array('user_id'=>$user));
if($query->num_rows()>0){
        foreach($query->result() as $row){
                $photo = $row->photo;
                $gamertag = $row->gamertag;
        }
        echo img($photo,FALSE);
        if($gamertag !== ''){
                $xboxapi = $this->rest->get('profile/'.$gamertag.'/');
                if($xboxapi->Success>0){
                        $this->load->view('gamercard',$xboxapi->Player);
                } else {
                        $this->load->view('xboxapierror');
                }
        } else {
                $this->load->view('add_gamertag');
        }
        
}
?>