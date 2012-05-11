<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require 'REST_Controller.php';

class Api extends REST_Controller
{
    public $table = "events";
    //=========================================================={[+] CREATE 
    public function events_post(){
        $this->db->insert($this->table,json_decode($this->request->body));
        if($this->db->affected_rows()>0){
            $this->response(array('id'=>$this->db->insert_id()));
        } else {
            $this->response(array('status' => 'failed'));
        }
    }
    //=========================================================={[=] READ
    public function events_get(){
        $events = $this->db->get($this->table);
    	if($events->num_rows()<1) $this->response(array('error' => 'No Events Listed'),404); else $this->response($events->result(),200);
    }
    //=========================================================={[*] UPDATE 
    public function events_put(){
        $req = json_decode($this->request->body); unset($req->status); 
        if($this->db->update($this->table,$req,array('id'=>$this->get('id')))){
            $array = array(array('status'=>'success'),200);
        } else {
            $array = array(array('status'=>'failed'),500);
        }
        $this->response($array[0],$array[1]);
    }
    //=========================================================={[-] DELETE
    public function events_delete(){
        if($this->db->delete($this->table, array('id' => $this->get('id')))){
            $this->response(array('status'=>'success'),200);
        } else {
            $this->response(array('status'=>'failed'),500);
        }
    }
}

