<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//@todo doman zrobić użytowknika w mysql dla tego panelu i ograniczyć mu prawa
//@todo doman zrobić panel porównania?
//@todo doman spolszczyć komunikaty
class Main extends CI_Controller {
	//Ursynów
	//public $place = 1;
	//Centrum
	public $place = 2;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('main_model');
	}
	

public function index()	{
		$this->load->model('visits_model');
		$config['visits'] = $this->visits_model->get_visits($this->place);
		$config['view']='pages/index.php';
		$this->load->view('templates/content',$config);
	}
	
	public function show_offers(){
		$config['offers']=$this->main_model->show_offersm();
		$config['categories']=$this->main_model->show_categoriesm();
		$config['view']= 'pages/show_offers';
		$this->load->view('templates/content',$config);
	}

	public function find_client(){
		$client_arr['client_number']=$this->input->post('client_number');
		$client_arr['client_name']=$this->input->post('client_name');
		$client_arr['client_surname']=$this->input->post('client_surname');
		$config['clients'] = $this->main_model->find_client($client_arr,'client');
		$config['view'] = 'pages/show_finds';
		$this->load->view('templates/content',$config);
	}
	
	public function show_client(){
		$id=$this->uri->segment(3);
		$config['note'] = $this->main_model->show_client_note($id);
		$config['client']=$this->main_model->show_client($id);
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
		$clients_array['client_number'] = $this->input->post('client_number');
		$clients_array['client_newsletter'] = $this->input->post('client_newsletter');
		$clients_array['client_regdate'] = date('Y-m-d H:i:s');
		$client_question = $this->input->post('client_question');
		if (!$this->main_model->insert_clientm($clients_array,$client_question)){
			$this->session->set_flashdata('last_post',$clients_array);
			$this->session->set_flashdata('client_question',$client_question);
		}
		redirect(base_url('main/add_client'));
	}
	
	public function edit_client(){
		echo 'Panel edycji klienta';
	
	}
	
	public function update_client(){
		echo 'Funkcja updatująca';
	
	}
	
	public function login() {
				
	}

 //sekcja wizyt

	public function client_exists(){
		$this->load->model('visits_model');
		$client['client_number'] = $this->input->post('client_number')?$this->input->post('client_number'):$this->session->userdata('client_number'); // ta druga możliwość wystąpi przy przesyłaniu numeru z visits/add_visit
		$this->session->unset_userdata('client_number');
		$config['client'] = $this->main_model->find_client($client,'client');
		$client = $config['client'];
		if ($client) {
			
				if ($client[0]['client_doubled'] != 1 ){
					$gender = $client[0]['client_gender'];
					$config['categories']=$this->visits_model->get_categories($gender);
					
					$config['offers']=$this->visits_model->get_offers();
					$config['view']='visits/choose_proc';
					$this->load->view('templates/content',$config);
				}
				else{
					$this->session->set_flashdata('error','Istnieje klient o tym samym imieniu i nazwisku. Wymagane jest dodanie wyróżnika');
					redirect(base_url('main/edit_client'));
				}
			
		}else{
			$this->session->set_flashdata('error','Nie ma klienta o takim numerze w bazie</br> Sprawdź poprawność numeru lub wyszukaj numer przez Imię i nazwisko.</br>');
			redirect(base_url('visits'));
		}
	}

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */