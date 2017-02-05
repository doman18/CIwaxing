<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('main_model');
	}
	
	public function index()	{
		$config['view']='pages/index.php';
		$this->load->view('templates/content',$config);
	}
	
	public function find_person(){
		$person_arr['person_number']=$this->input->post('person_number');
		$person_arr['person_name']=$this->input->post('person_name');
		$person_arr['person_surname']=$this->input->post('person_surname');
		$config['clients'] = $this->main_model->find_person($person_arr,'client');
		$config['workers'] = $this->main_model->find_person($person_arr,'worker');
		$config['view'] = 'pages/show_finds';
		$this->load->view('templates/content',$config);
	}

	public function login() {
		$this->load->view('templates/content');
		
	}

		
		
	}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */