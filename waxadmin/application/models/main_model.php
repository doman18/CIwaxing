<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_Model extends MY_Model{
	
	
	public function find_person($person_arr,$name){
		$where=array();
		if(!empty($person_arr['person_number'])){
			$where[$name.'_number'] = $person_arr['person_number'];
		}
		if(!empty($person_arr['person_name'])){
			$where[$name.'_name'] = $person_arr['person_name'];
		}
		if(!empty($person_arr['person_surname'])){
			$where[$name.'_surname'] =$person_arr['person_name'];
		}
		
		
		$query = $this->db->select('*')->where($where)->get($name.'s');
		
		if ($query->num_rows()>0) {
			return $query->result_array();
		}
		else{
			return FALSE;
		}
	}
	
}