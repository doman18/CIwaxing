<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//@todo doman stworzyć listę użytych numerów klientów w bazie i dodatkową walidację dla tej listy 
class Workers extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('workers_model');
	}
	
	public function index(){
		$config['workers']=$this->workers_model->show_workers();
		$config['salons']=$this->workers_model->show_salons();
		$config['view']= 'workers/show_workers';
		$this->load->view('templates/content',$config);
	}
	
	public function show_worker(){
		$config['worker']=$this->workers_model->show_worker($this->uri->segment(3));
		$config['view']='workers/show_worker';
		$this->load->view('templates/content',$config);
	}
	
	public function add_worker(){
		$config['salons']=$this->workers_model->show_salons();
		$config['view']= 'workers/add_worker';
		$this->load->view('templates/content',$config);
	}
	
	public function insert_worker(){
		$workers_array = array();
		$workers_array['worker_name'] = $this->input->post('worker_name');
		$workers_array['worker_surname'] = $this->input->post('worker_surname');
		$workers_array['worker_phone'] = $this->input->post('worker_phone');
		$workers_array['worker_mail'] = $this->input->post('worker_mail');
		$workers_array['worker_address'] = $this->input->post('worker_address');
		$workers_array['worker_number'] = $this->input->post('worker_number');
		$workers_array['worker_password'] = $this->input->post('worker_password');
		$workers_array['worker_place'] = $this->input->post('worker_place');
		$workers_array['worker_regdate'] = date('Y-m-d H:i:s');
		if (!$this->workers_model->insert_workerm($workers_array)){
			$this->session->set_flashdata('last_post',$workers_array);
		}
		redirect(base_url('workers/add_worker'));
	}
	
	public function edit_worker(){
		$config['salons']=$this->workers_model->show_salons();
		$config['worker'] = $this->workers_model->show_worker($this->uri->segment(3));
		$config['view']= 'workers/edit_worker';
		$this->load->view('templates/content',$config);
	
	}
	
	public function update_worker(){
		$workers_array = array();
		$id = $this->uri->segment(3);
		$workers_array['worker_name'] = $this->input->post('worker_name');
		$workers_array['worker_surname'] = $this->input->post('worker_surname');
		$workers_array['worker_phone'] = $this->input->post('worker_phone');
		$workers_array['worker_mail'] = $this->input->post('worker_mail');
		$workers_array['worker_address'] = $this->input->post('worker_address');
		$workers_array['worker_number'] = $this->input->post('worker_number');
		$workers_array['worker_password'] = $this->input->post('worker_password');
		$workers_array['worker_place'] = $this->input->post('worker_place');		
		if (!$this->workers_model->update_workerm($id,$workers_array)){
			$this->session->set_flashdata('last_post',$workers_array);
		}
		redirect(base_url('workers/edit_worker/'.$id));
	}
	
	public function delete_worker(){
		$config['worker'] = $this->workers_model->show_worker($this->uri->segment(3));
		$config['view']= 'workers/delete_worker';
		$this->load->view('templates/content',$config);
	}
	
	public function erase_worker(){
		$this->workers_model->erase_workerm($this->uri->segment(3));
		redirect(base_url('workers'));
	}
	
}