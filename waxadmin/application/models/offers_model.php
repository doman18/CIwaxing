<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class offers_Model extends MY_Model{
	
	public function show_offers(){
		return $this->get_items('offers');
	}
	
	public function show_offer($id){
		return $this->get_item(array('offer_id'=>$id), 'offers');
	}
	
	public function insert_offerm($offers_array){
		$this->form_validation->set_rules('offer_name','Nazwa','xss_clean|required');
		$this->form_validation->set_rules('offer_price','Cena','xss_clean|required|numeric');
		$this->form_validation->set_rules('offer_points','Punkty','numeric|xss_clean');
		$this->form_validation->set_rules('offer_points_price','Koszt punktów','xss_clean|numeric');
		$this->form_validation->set_rules('offer_min_time','Minimalny czas','xss_clean|numeric');
		$this->form_validation->set_rules('offer_max_time','Maksymalny czas','xss_clean|numeric');
		
		if ($this->form_validation->run()) {
			//sprawdzam dublowanie się nazwy w tej samej kategorii
			$query =$this->db->select('*')->where(array('offer_name'=>$offers_array['offer_name'],'offer_category'=>$offers_array['offer_category']))->get('offers');
			if($query->num_rows()>0){
				$this->session->set_flashdata('error','Istnieje już oferta o tej nazwie w tej samej kategorii');
				return FALSE;
			}
			else{
			$this->insert_item($offers_array, 'offers', 'ofertę');
			return TRUE;
			}
		}
		else {
			$this->session->set_flashdata('error',validation_errors());
			return FALSE;
		}
	}
	
	public function update_offerm($id, $offers_array){
		$this->form_validation->set_rules('offer_name','Nazwa','xss_clean|required');
		$this->form_validation->set_rules('offer_price','Cena','xss_clean|required|numeric');
		$this->form_validation->set_rules('offer_points','Punkty','numeric|xss_clean');
		$this->form_validation->set_rules('offer_points_price','Koszt punktów','xss_clean|numeric');
		$this->form_validation->set_rules('offer_min_time','Minimalny czas','xss_clean|numeric');
		$this->form_validation->set_rules('offer_max_time','Maksymalny czas','xss_clean|numeric');
		
		if ($this->form_validation->run()) {
			//sprawdzam dublowanie się nazwy w tej samej kategorii
			$query =$this->db->select('*')->where(array('offer_name'=>$offers_array['offer_name'],'offer_category'=>$offers_array['offer_category']))->where_not_in('offer_id',$id)->get('offers');
			if($query->num_rows()>0){
				$this->session->set_flashdata('error','Istnieje już oferta o tej nazwie w tej samej kategorii');
				return FALSE;
			}
			else{
			$this->update_item(array('offer_id'=>$id), $offers_array, 'offers', 'ofertę');
			return TRUE;
			}
		}
		else {
			$this->session->set_flashdata('error',validation_errors());
			return FALSE;
		}
		
	}
	
	public function erase_offerm($id){
		return $this->erase_item(array('offer_id'=>$id), 'offers', 'ofertę');
	}
	
	//Modele kategorii
	public function show_categories(){
		return $this->get_items('categories');
	}
	
	public function insert_catm($cat_array){
		$this->form_validation->set_rules('category_name','Nazwa','xss_clean|required');
		if ($this->form_validation->run()){
			if ($this->insert_item($cat_array, 'categories', 'kategori')) return TRUE;
			else {
				$this->session->set_flashdata('error','Nie udało się dodać kategorii do bazy');
				return FALSE;
			}
		}else{
		$this->session->set_flashdata('error',validation_errors());
		return FALSE;
		}
	}
	
	public function update_catm($id,$cat_array){
		$this->form_validation->set_rules('category_name','Nazwa','xss_clean|required|is_unique[categories.categori_name]');
		if ($this->form_validation->run()){
			$this->update_item(array('category_id'=>$id), $cat_array, 'categories', 'kategori');
			return TRUE;
		}else{
		$this->session->set_flashdata('error',validation_errors());
		return FALSE;
		}
	}
	
	public function check_category($id){
		$query = $this->db->select('*')->where('offer_category',$id)->get('offers'); //sprawdzam czy istnieją oferty w tej kategorii
		if ($query->num_rows()>0){
			return FALSE;
		}
		else{
			return $this->get_item(array('category_id'=>$id), 'categories'); 
		}
	}
	
	public function erase_catm($id) {
		$this->erase_item(array('category_id'=>$id), 'categories', 'kategorii');
	}
	
}