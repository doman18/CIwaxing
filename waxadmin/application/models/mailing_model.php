<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailing_Model extends MY_Model{
	
	public function get_conf(){
		return $this->get_items('smtp_sett');
	}
	
	public function get_mails($foreigner){
		
		$query = $this->db->select('client_mail')->where_not_in('client_mail','NULL')->where(array('client_newsletter'=>1,'client_foreigner'=>$foreigner))->get('clients');
		if ($query->num_rows()>0){
			return $query->result_array();
		}
		else{
			return FALSE;
		}
	}
}