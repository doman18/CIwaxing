<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offers extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('offers_model');
	}
	
	public function index(){
		$config['offers']=$this->offers_model->show_offers();
		$config['categories']=$this->offers_model->show_categories();
		$config['view']= 'offers/show_offers';
		$this->load->view('templates/content',$config);
	}
	
	public function show_offer(){
		$config['offer']=$this->offers_model->show_offer($this->uri->segment(3));
		$config['view']='offers/show_offer';
		$this->load->view('templates/content',$config);
	}
	
	public function add_offer(){
		$config['categories']=$this->offers_model->show_categories();
		$config['view']= 'offers/add_offer';
		$this->load->view('templates/content',$config);
	}
	
	public function insert_offer(){
		$offers_array = array();
		$offers_array['offer_name'] = $this->input->post('offer_name');
		$offers_array['offer_price'] = $this->input->post('offer_price');
		$offers_array['offer_category'] = $this->input->post('offer_category');
		$offers_array['offer_points_price'] = $this->input->post('offer_points_price');
		$offers_array['offer_min_time'] = $this->input->post('offer_min_time');
		$offers_array['offer_max_time'] = $this->input->post('offer_max_time');
		if (!$this->offers_model->insert_offerm($offers_array)){
			$this->session->set_flashdata('last_post',$offers_array);
		}
		redirect(base_url('offers/add_offer'));
	}
	
	public function edit_offer(){
		$config['categories']=$this->offers_model->show_categories();
		$config['offer'] = $this->offers_model->show_offer($this->uri->segment(3));
		$config['view']= 'offers/edit_offer';
		$this->load->view('templates/content',$config);
	
	}
	
	public function update_offer(){
		$offers_array = array();
		$id = $this->uri->segment(3);
		$offers_array['offer_name'] = $this->input->post('offer_name');
		$offers_array['offer_price'] = $this->input->post('offer_price');
		$offers_array['offer_category'] = $this->input->post('offer_category');
		$offers_array['offer_points_price'] = $this->input->post('offer_points_price');
		$offers_array['offer_min_time'] = $this->input->post('offer_min_time');
		$offers_array['offer_max_time'] = $this->input->post('offer_max_time');		
		if (!$this->offers_model->update_offerm($id,$offers_array)){
			$this->session->set_flashdata('last_post',$offers_array);
		}
		redirect(base_url('offers/edit_offer/'.$id));
	}
	
	public function delete_offer(){
		$config['offer'] = $this->offers_model->show_offer($this->uri->segment(3));
		$config['view']= 'offers/delete_offer';
		$this->load->view('templates/content',$config);
	}
	
	public function erase_offer(){
		$this->offers_model->erase_offerm($this->uri->segment(3));
		redirect(base_url('offers'));
	}
	
	// Funkcje kategorii
	
	public function cat_mgmt(){
		$config['categories']=$this->offers_model->show_categories();
		$config['view']= 'offers/cat_mgmt';
		$this->load->view('templates/content',$config);
	}
	
	public function insert_cat(){
	 $cat_array['category_name'] = $this->input->post('category_name');
	 $cat_array['category_gender'] = $this->input->post('category_gender');
	 $this->offers_model->insert_catm($cat_array);
	 redirect(base_url('offers/cat_mgmt'));
	}
	
	public function update_cat(){
		$id = $this->uri->segment(3);
		$cat_array['category_name'] = $this->input->post('category_name');
		$cat_array['category_gender'] = $this->input->post('category_gender');
		$this->offers_model->update_catm($id,$cat_array);
		redirect(base_url('offers/cat_mgmt'));
	}
	
	public function delete_cat(){
		$config['category'] = $this->offers_model->check_category($this->uri->segment(3));
		if (!$config['category']){
			
				$this->session->set_flashdata('error','Nie moża usunąć kategorii w których są oferty. Usuń najpierw oferty tej kategorii i spróbuj ponownie');
				redirect(base_url('offers/cat_mgmt'));
			
		}
		else{
		$config['view']= 'offers/del_cat';
		$this->load->view('templates/content',$config);
		}
	}
	
	public function erase_cat(){
		
		$this->offers_model->erase_catm($this->uri->segment(3));
		redirect(base_url('offers/cat_mgmt'));
	
	}
	
}