<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clients_Model extends MY_Model{
	
	public function show_client_note($id){
		return $this->get_item(array('note_client'=>$id), 'client_notes');
	}
	
	public function show_clients(){
		return $this->get_items('clients');
	}
	
	public function show_client($id){
		return $this->get_item(array('client_id'=>$id), 'clients');
	}
	
	public function insert_clientm($clients_array,$client_question){
		$this->form_validation->set_rules('client_number','Numer','xss_clean|required|is_unique[clients.client_number]|is_natural_no_zero');
		$this->form_validation->set_rules('client_name','Imię','xss_clean|required|alpha');
		$this->form_validation->set_rules('client_surname','Nazwisko','xss_clean|required|alpha');
		$this->form_validation->set_rules('client_phone','Telefon','is_natural|xss_clean');
		$this->form_validation->set_rules('client_address','Adres','xss_clean');
		$this->form_validation->set_rules('client_mail','Email','xss_clean|is_unique[clients.client_mail]|valid_email');
		$this->form_validation->set_rules('client_password','Hasło','xss_clean');
	//sprawdzam dublowanie się nazwy w tej samej kategorii
		$query =$this->db->select('*')->where(array('client_name'=>$clients_array['client_name'],'client_surname'=>$clients_array['client_surname']))->get('clients');
		foreach ($query->result_array() as $key=>$value){
			$other_client_id[]=$value['client_id'];
		}
		if($query->num_rows()>0){
			$this->form_validation->set_rules('client_question','Wyróżnik','xss_clean|required');
			$this->session->set_flashdata('warning','Klient o takim imieniu i nazwisku już istnieje w bazie."');

			
		}
		else{
			$this->form_validation->set_rules('client_question','Wyróżnik','xss_clean');
			
		}
		
		if ($this->form_validation->run()) {
			$this->insert_item($clients_array, 'clients', 'użytkownika');
				//biorę id dopiero co dodanego klienta i wrzucam go razem z treścią wyróżnika do tablicy wyróżników
				if($query->num_rows()>0){
					$client_id = $this->db->select('client_id')->where('client_number',$clients_array['client_number'])->get('clients');
					foreach ($client_id->result_array() as $key=>$value){
						$client_id=$value['client_id'];
					}
				
				$query = $this->db->insert('client_notes',array('note_client'=>$client_id,'note_content'=>$client_question));
					
					
					//robię update komórki client_doubled dla drugiej osoby ustawiając ją na 1. Pętla jest po to gdyby było więcej powtórzeń
					foreach ($other_client_id as $id){
						if(!$this->show_client_note($id)){ //updatuje tylko te ktore nie mają ustawionej notatki
						$this->db->where('client_id',$id)->update('clients',array('client_doubled'=>1));
						}
					}
				}
			return TRUE;
		}
		else {
			$this->session->set_flashdata('error',validation_errors());
			return FALSE;
		}
	}
	
	public function update_clientm($id, $clients_array, $client_question){
		$this->form_validation->set_rules('client_number','Numer','xss_clean|required|is_natural_no_zero');
		$this->form_validation->set_rules('client_name','Imię','xss_clean|required|alpha');
		$this->form_validation->set_rules('client_surname','Nazwisko','xss_clean|required|alpha');
		$this->form_validation->set_rules('client_phone','Telefon','is_natural|xss_clean');
		$this->form_validation->set_rules('client_address','Adres','xss_clean');
		$this->form_validation->set_rules('client_mail','Email','xss_clean|valid_email');
		$this->form_validation->set_rules('client_password','Hasło','xss_clean');
		$this->form_validation->set_rules('client_points','Punkty','xss_clean|is_natural');
		$this->form_validation->set_rules('client_visit_count','Licznik wizyt','xss_clean|is_natural');
		$this->form_validation->set_rules('client_visit_sum','Suma wizyt','xss_clean|is_natural');
		
		//sprawdzam dublowanie się nazwy w tej samej kategorii (z wyłączeniem aktualnie edytowanego klienta)
		$where = array('client_name'=>$clients_array['client_name'],'client_surname'=>$clients_array['client_surname']);
		$query =$this->db->select('*')->where($where)->where_not_in('client_id',$id)->get('clients');
		foreach ($query->result_array() as $key=>$value){
			$other_client_id[]=$value['client_id'];
		}
		if($query->num_rows()>0){
			$this->form_validation->set_rules('client_question','Wyróżnik','xss_clean|required');
			$this->session->set_flashdata('warning','Klient o takim imieniu i nazwisku już istnieje w bazie."');
		}
		else{
			$this->form_validation->set_rules('client_question','Wyróżnik','xss_clean');
				
		}
		
		if ($this->form_validation->run()) {
			$this->update_item(array('client_id'=>$id), $clients_array, 'clients', 'klienta');
			//ponowne sprawdzenie podwójności nazwiska
			if($query->num_rows()>0){
				//sprawdzenie czy notatka istnieje czy nie;
				$query = $this->db->select('*')->where('note_client',$id)->get('client_notes');
					if($query->num_rows()>0){ //jeżeli tak to zupdatuj treść
					$this->db->where('note_client',$id)->update('client_notes',array('note_content'=>$client_question));
					}
					else{
					$this->db->insert('client_notes',array('note_client'=>$id,'note_content'=>$client_question));
					$this->db->where('client_id',$id)->update('clients',array('client_doubled'=>0)); //zeruje wartość dublowania po dodaniu notki
					}
					
					
					//robię update komórki client_doubled dla drugiej osoby ustawiając ją na 1. Pętla jest po to gdyby było więcej powtórzeń
					foreach ($other_client_id as $id){
						if(!$this->show_client_note($id)){ //updatuje tylko te ktore nie mają ustawionej notatki
							$this->db->where('client_id',$id)->update('clients',array('client_doubled'=>1));
						}
					}
			}
			return TRUE;
		}
		else {
			$this->session->set_flashdata('error',validation_errors());
			return FALSE;
		}
		
	}
	
	
	//ta funkcja jeszcze nie jest użyta ale może później
	public function is_double(){
		$query = $this->db->select('*')->where('note_client',$id)->get('client_notes');
		if($query->num_rows()>0){ //jeżeli tak to zupdatuj treść
			$this->db->where('note_client',$id)->update('client_notes',array('note_content'=>$client_question));
		}
		else{
			$this->db->insert('client_notes',array('note_client'=>$id,'note_content'=>$client_question));
		}
	}
	
}