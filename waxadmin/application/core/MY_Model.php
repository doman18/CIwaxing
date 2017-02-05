<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_items($tab_name){
		$query = $this->db->select('*')->get($tab_name);
		if ($query->num_rows() > 0 ){
			return $query->result_array();
		}
		else {
			return FALSE;
		}
	
	}
	
	public function joined_items($tab_name, $joining_tab_name,$joing_statement){
		$query = $this->db->select('*')->join($joining_tab_name, $joing_statement)->get($tab_name);
		if ($query->num_rows() > 0 ){
			return $query->result_array();
		}
		else {
			return FALSE;
		}
	
	}
	
	public function get_item($where,$tab_name){
		$query = $this->db->select('*')->where($where)->get($tab_name);
		if ($query->num_rows() > 0 ){
			return $query->result_array();
		}
		else {
			return FALSE;
		}
	}
	
	public function insert_item($tab_item,$tab_name,$msg_item){
		$query = $this->db->insert($tab_name,$tab_item);
		if ($query) {
			$this->session->set_flashdata('success','Udało się dodać '.$msg_item);
			return TRUE;
		}
		else {
			$this->session->set_flashdata('error','Nie udało się dodać '.$msg_item.'. Błąd bazy');
			return FALSE;
		}
		
	}
	
	public function update_item($where,$tab_item,$tab_name,$msg_item){
		$query = $this->db->where($where)->update($tab_name,$tab_item);
		if ($query) {
			$this->session->set_flashdata('success','Udało się zmienić '.$msg_item);
			return TRUE;
		}
		else {
			$this->session->set_flashdata('error','Nie udało się  zmienić '.$msg_item.'. Błąd bazy');
			return FALSE;
		}
	}
	
	public function erase_item($where,$tab_name,$msg_item){
		$query = $this->db->where($where)->delete($tab_name);
		$success = $msg_item.' został usunięty';
		if ($query) {
			$this->session->set_flashdata('success','Usunięto '.$msg_item);
			return TRUE;
		}
		else {
			$this->session->set_flashdata('error','Nie udało się usunąć '.$msg_item.'. Błąd bazy');
			return FALSE;
		}	
	}
	

}