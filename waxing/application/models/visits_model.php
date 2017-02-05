<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visits_Model extends MY_Model{
	
	public function get_categories($gender){
		$query = $this->db->select('*')->where('category_gender',$gender)->get('categories');
		return $query->num_rows()>0 ?$query->result_array():FALSE;
	}
	
	public function get_offers(){
		$this->db->trans_start();
		return $this->get_items('offers');
		$this->db->trans_complete();
	}
	
	public function get_worker_v($worker_number){
		$this->validation->set_rules('worker_number', 'Numer pracownika', 'required|numeric');
		$query = $this->db->select('worker_id,worker_name,worker_surname,worker_place')->where('worker_number',$worker_number)->get('workers');
		if ($this->validation->run()){
			
			if($query->num_rows()>0){
				return $query->result_array();
			}
			else{
				return FALSE;
			}
		}else{
			$this->session->set_flashdata('error',validation_errors());
			return FALSE;
		}
	}
	
	public function get_workerm($id){
		return $this->get_item(array('worker_id'=>$id),'workers');
	
	}
	
	//wizyty
	public function get_visits($place)
	{
		$query = $this->db->select('*')->where(array('visit_stop'=>'00:00:00','visit_place'=>$place))->join('clients','clients.client_id=visits.visit_client')->get('visits');
		if ($query->num_rows()>0){
			return $query->result_array();
		}
		else{
			return FALSE;
		}
	}
	
	public function get_visit($visit_id){
		$query = $this->db->select('*')->where('visit_id',$visit_id)->join('clients','clients.client_id=visits.visit_client')->join('procedures','procedures.proced_visit=visits.visit_id')->join('offers','offers.offer_id=procedures.proced_offer')->get('visits');
		if ($query->num_rows()>0){
		return $query->result_array();
		}
		else{
		return FALSE;
		}
		}
	
	public function instert_all($visit_arr,$offers){
		$this->db->trans_begin(); //rozpoczynam transakcję. Jeżeli dodanie wizyty lub którejkolwiek oferty się nie powiedzie, całe dodawanie się nie powiedzie.
		$this->db->insert('visits',$visit_arr);
		$proced_arr['proced_visit'] = $this->db->insert_id(); //przekazuję id ostatnio dodanej wizyty do tablicy każdego związanego z nią zabiegu
		$proced_arr['proced_change'] = 1;
		$success = '';
		$error = '';
		if ($proced_arr['proced_visit']) {
			foreach ($offers as $value){ //w pętli przekazuje id każdego zabiego i insertuje cały zabieg
				$proced_arr['proced_offer']=$value['id'];
				$proced_arr['proced_offer_n']=$value['name'];
				if ($this->db->insert('procedures',$proced_arr)){ //buduję raport dodania ofert
					$success .= 'Dodano ofertę "'.$proced_arr['proced_offer_n'].'" do bazy</br>';
				}
				else {
					$error .= 'Nie udało się dodać "'.$proced_arr['proced_offer_n'].'" do bazy</br>';
				}
			}
			
			if ($this->db->trans_status() === TRUE) //jeżeli wszystko się powiodło, zapisz zmiany, jeżeli nie cofnij
				 {
				 	$this->session->set_flashdata('success','Dodano wizytę do bazy</br>'); //wyświetli wszystkie dodane i te które się nie udało
				 	$this->db->trans_commit();
				 }
				 else
				 {
				 	$this->session->set_flashdata('success',$success); //wyświetli wszystkie dodane i te które się nie udało
				 	$this->session->set_flashdata('error','Wykryto błędy:</br>'.$error.' Operacja dodania wizyty nie powiodła się');
				 	$this->db->trans_rollback();
				 }
						
			redirect(base_url('main'));
		}
		else {
			
			$this->session->set_flashdata('error','Nie udało się dodać wizyty, błąd odwołania do bazy');
			redirect(base_url('visits'));
		}
	}
	
	public function update_all($visit_id,$client_id,$visit_arr,$offers,$points) {
		$this->db->trans_begin(); //rozpoczynam transakcję. Jeżeli dodanie wizyty lub którejkolwiek oferty się nie powiedzie, całe dodawanie się nie powiedzie.;
		$query = $this->db->where('visit_id',$visit_id)->update('visits',$visit_arr);
		
		$success = '';
		$error = '';
		if ($query) {
			foreach ($offers as $value){ //w pętli przekazuje id każdego zabiego
				if ($value['change']== 2) { //jeżeli oferta ma znacznik zatwierdzenia to robię update oferty
					$proced_arr['proced_change']=2;
					$this->db->where(array('proced_visit'=>$visit_id,'proced_offer'=>$value['id']))->update('procedures',$proced_arr);
						if ($this->db->where(array('proced_visit'=>$visit_id,'proced_offer'=>$value['id']))->update('procedures',$proced_arr)){ //buduję raport dodania ofert
							$success .= 'Zaktualizowano ofertę '.$value['name'].'</br>';
						}
						else {
							$error .= 'Nie udało się zaktualizować oferty '.$value['name'].'</br>';
						}
				}  
				elseif ($value['change']== 3) {
					$proced_arr['proced_visit'] = $visit_id;
					$proced_arr['proced_change']=3;
					$proced_arr['proced_offer']=$value['id'];
					$proced_arr['proced_offer_n']=$value['name'];
						if ($this->db->insert('procedures',$proced_arr)){ //buduję raport dodania ofert
							$success .= 'Dodano ofertę "'.$proced_arr['proced_offer_n'].'" do bazy</br>';
						}
						else {
							$error .= 'Nie udało się dodać "'.$proced_arr['proced_offer_n'].'" do bazy</br>';
						}
				}
				
			}
			
		$cli_arr['client_points'] += $points;
		++$cli_arr['client_visit_count'];
		$cli_arr['client_visit_sum'] += $visit_arr['visit_proced_sum'];
		$this->db->where('client_id', $client_id)->update('clients',$cli_arr);
		
		
		if ($this->db->trans_status() === TRUE) //jeżeli wszystko się powiodło, zapisz zmiany, jeżeli nie cofnij
		{
			$this->session->set_flashdata('success','Wizyta została zakończona poprawnie</br>'); //wyświetli wszystkie dodane i te które się nie udało
			$this->db->trans_commit();
			$this->db->trans_off();
		}
		else
		{
			$this->session->set_flashdata('success',$success); //wyświetli wszystkie dodane i te które się nie udało
			$this->session->set_flashdata('error','Wykryto błędy:</br>'.$error.' Operacja zatwierdzenia wizyty nie powiodła się');
			$this->db->trans_rollback();
			$this->db->trans_off();
		}
		
		redirect(base_url('main'));
		}
		else {
				
			$this->session->set_flashdata('error','Nie udało się dodać wizyty, błąd odwołania do bazy');
			redirect(base_url('visits/edit_visit/'.$visit_id));
			$this->db->trans_off();
		}
	
	
	}
	
	
}