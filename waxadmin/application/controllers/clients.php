<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clients extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('clients_model');
	}
	
	public function index(){
		$config['clients']=$this->clients_model->show_clients();
		$config['view']= 'clients/show_clients';
		$this->load->view('templates/content',$config);
	}
	
	public function show_client(){
		
		$id=$this->uri->segment(3);
		$config['note'] = $this->clients_model->show_client_note($id);
		$config['client']=$this->clients_model->show_client($id);
		$config['view']='clients/show_client';
		$this->load->view('templates/content',$config);
	}
	
	public function add_client(){
		$config['view']= 'clients/add_client';
		$this->load->view('templates/content',$config);
	}
	
	public function insert_client(){
		$clients_array = array();
		$clients_array['client_name'] = $this->input->post('client_name');
		$clients_array['client_surname'] = $this->input->post('client_surname');
		$clients_array['client_gender'] = $this->input->post('client_gender');
		$clients_array['client_foreign'] = $this->input->post('client_foreign');
		$clients_array['client_phone'] = $this->input->post('client_phone');
		$clients_array['client_mail'] = $this->input->post('client_mail');
		$clients_array['client_address'] = $this->input->post('client_address');
		$clients_array['client_number'] = $this->input->post('client_number');
		$clients_array['client_password'] = $this->input->post('client_password');
		$clients_array['client_newsletter'] = $this->input->post('client_newsletter');
		$clients_array['client_regdate'] = date('Y-m-d H:i:s');
		$client_question = $this->input->post('client_question');
		if (!$this->clients_model->insert_clientm($clients_array,$client_question)){
			$this->session->set_flashdata('last_post',$clients_array);
			$this->session->set_flashdata('client_question',$client_question);
		}
		redirect(base_url('clients/add_client'));
	}
	
	public function edit_client(){
		$id = $this->uri->segment(3);
		$query = $this->db->select('note_content')->where('note_client',$id)->get('client_notes');
		foreach ($query->result_array() as $key=>$value){
			$config['client_question'] = $value['note_content'];
		}
		$config['client'] = $this->clients_model->show_client($id);
		$config['view']= 'clients/edit_client';
		$this->load->view('templates/content',$config);
	
	}
	
	public function update_client(){
		$clients_array = array();
		$id = $this->uri->segment(3);
		$clients_array['client_name'] = $this->input->post('client_name');
		$clients_array['client_surname'] = $this->input->post('client_surname');
		$clients_array['client_gender'] = $this->input->post('client_gender');
		$clients_array['client_foreign'] = $this->input->post('client_foreign');
		$clients_array['client_phone'] = $this->input->post('client_phone');
		$clients_array['client_mail'] = $this->input->post('client_mail');
		$clients_array['client_address'] = $this->input->post('client_address');
		$clients_array['client_number'] = $this->input->post('client_number');
		$clients_array['client_password'] = $this->input->post('client_password');
		$clients_array['client_newsletter'] = $this->input->post('client_newsletter');
		$clients_array['client_points'] = $this->input->post('client_points');
		$clients_array['client_visit_count'] = $this->input->post('client_visit_count');
		$clients_array['client_visit_sum'] = $this->input->post('client_visit_sum');
		$client_question = $this->input->post('client_question');
		
		
		if (!$this->clients_model->update_clientm($id,$clients_array,$client_question)){
			$this->session->set_flashdata('last_post',$clients_array);
			$this->session->set_flashdata('client_question',$client_question);
		}
		redirect(base_url('clients/edit_client/'.$id));
	}
	
	public function delete_client(){
		$config['client_id'] = $this->uri->segment(3);
		$config['view']= 'clients/delete_client';
		$this->load->view('templates/content',$config);
	}
	
	public function erase_client(){
	
	}
	
}