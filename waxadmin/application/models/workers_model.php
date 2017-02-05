<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workers_Model extends MY_Model{
	public function show_salons(){
		return $this->get_items('salons');
	}
	
	public function show_workers(){
		return $this->get_items('workers');
	}
	
	public function show_worker($id){
		return $this->get_item(array('worker_id'=>$id), 'workers');
	}
	
	public function insert_workerm($workers_array){
		$this->form_validation->set_rules('worker_number','Numer','xss_clean|required|is_unique[workers.worker_number]|numeric');
		$this->form_validation->set_rules('worker_name','Imię','xss_clean|required|alpha');
		$this->form_validation->set_rules('worker_surname','Nazwisko','xss_clean|required|alpha');
		$this->form_validation->set_rules('worker_phone','Telefon','numeric|xss_clean');
		$this->form_validation->set_rules('worker_address','Adres','xss_clean');
		$this->form_validation->set_rules('worker_mail','Email','xss_clean|is_unique[workers.worker_mail]|valid_email');
		$this->form_validation->set_rules('worker_password','Hasło','xss_clean');
		
		if ($this->form_validation->run()) {
			$this->insert_item($workers_array, 'workers', 'pracownika');
			return TRUE;
		}
		else {
			$this->session->set_flashdata('error',validation_errors());
			return FALSE;
		}
	}
	
	public function update_workerm($id, $workers_array){
		$this->form_validation->set_rules('worker_number','Numer','xss_clean|required|numeric');
		$this->form_validation->set_rules('worker_name','Imię','xss_clean|required|alpha');
		$this->form_validation->set_rules('worker_surname','Nazwisko','xss_clean|required|alpha');
		$this->form_validation->set_rules('worker_phone','Telefon','numeric|xss_clean');
		$this->form_validation->set_rules('worker_address','Adres','xss_clean');
		$this->form_validation->set_rules('worker_mail','Email','xss_clean|valid_email');
		$this->form_validation->set_rules('worker_password','Hasło','xss_clean');

		
		if ($this->form_validation->run()) {
			$this->update_item(array('worker_id'=>$id), $workers_array, 'workers', 'pracownika');
			return TRUE;
		}
		else {
			$this->session->set_flashdata('error',validation_errors());
			return FALSE;
		}
		
	}
	
	public function erase_workerm($id){
		return $this->erase_item(array('worker_id'=>$id), 'workers', 'pracownika');
	}
}