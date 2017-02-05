<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main_Model extends MY_Model{
	
	public function show_categoriesm(){
		return $this->get_items('categories');
	}
	
	public function show_offersm(){
		return $this->get_items('offers');
	}
	
	public function find_client($client_arr,$name){
		$where=array();
		if(!empty($client_arr['client_number'])){
			$where[$name.'_number'] = $client_arr['client_number'];
		}
		if(!empty($client_arr['client_name'])){
			$where[$name.'_name'] = $client_arr['client_name'];
		}
		if(!empty($client_arr['client_surname'])){
			$where[$name.'_surname'] =$client_arr['client_name'];
		}
		
		
		$query = $this->db->select('client_id,client_name,client_gender,client_surname,client_number,client_doubled,client_regdate')->where($where)->get($name.'s');
		
		if ($query->num_rows()>0) {
			return $query->result_array();
		}
		else{
			return FALSE;
		}
	}
	
	public function show_client_note($id){
		return $this->get_item(array('note_client'=>$id), 'client_notes');
		
	}
	
	public function show_client($id){
		return $this->get_item(array('client_id'=>$id), 'clients');
	}
	
	public function insert_clientm($clients_array,$client_question){
		$this->form_validation->set_rules('client_number','Numer','xss_clean|required|is_unique[clients.client_number]|numeric');
		$this->form_validation->set_rules('client_name','Imię','xss_clean|required|alpha');
		$this->form_validation->set_rules('client_surname','Nazwisko','xss_clean|required|alpha');
		
		//sprawdzam dublowanie się nazwy w tej samej kategorii
		$query =$this->db->select('*')->where(array('client_name'=>$clients_array['client_name'],'client_surname'=>$clients_array['client_surname']))->get('clients');
		foreach ($query->result_array() as $key=>$value){
			$other_client_id[]=$value['client_id']; // pętla bo może być ich więcej
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
}
