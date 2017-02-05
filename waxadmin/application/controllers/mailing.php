<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailing extends MY_Controller{
	
	public function __construct() {
		parent::__construct();
		$this->load->model('mailing_model');
	}
	
	public function index(){
		$config['view'] = 'mailing/create_mail';
		$this->load->view('templates/content',$config);
	}
	
	public function send(){
		/*$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'smtp.gmail.com',
				'smtp_port' => 465,
				'smtp_crypto' => 'ssl',
				'smtp_user' => 'doman180@gmail.com',
				'smtp_pass' => 'tajemniczehaslo',
				'mailtype'  => 'html',
				'charset'   => 'utf-8'
		);
		
		$config = Array(
				'protocol' => 'smtp',
				'mailtype'  => 'html',
				'charset'   => 'utf-8', // przy obcokrajowcach zmieni się kodowanie?
				'smtp_host' => 'smtp.1and1.pl',
				'smtp_port' => 587,
				'smtp_crypto' => 'tls',
				'smtp_user' => 'biuro@waxingstudio.pl',
				'smtp_pass' => 'tajemniczehaslo'
				
		);*/
		
		$conf = $this->mailing_model->get_conf();
		
		$conf[0]['protocol'] ='smtp';
		$conf[0]['mailtype'] ='html';
		$conf[0]['charset'] ='utf-8';
		
		//odróżnić obcokrajowców i płcie
		
		//$add_arr = array('doman18@tlen.pl','doman180@gmail.com');
		$add_arr = $this->mailing_model->get_mails($this->input->post('client_foreigner'));
		
		
		if ($add_arr != FALSE){
			if ($conf != FALSE){
				$this->load->library('email', $conf[0]);
				$this->email->set_newline("\r\n");
				
				$this->email->from('doman180@gmail.com', 'Doman'); //sprawdzanie czy jest adres czy po prostu w where dać że jest ogólnie adres
				$this->email->subject($this->input->post('subject')); //walidacja treści i tytułu?
				$this->email->message($this->input->post('content'));
				//$total = count($add_arr[0]);
				//$current = 0;
				//$config['view'] = 'mailing/progress';
				
					foreach ($add_arr as $value){
						//dodać procent stanu
						$this->email->to($value['client_mail']);
						$result = $this->email->send();
						//++$current;
						//$config['percent'] = round(($current/$total)*100);
						//$this->load->view('templates/content',$config);
						//$this->session->set_userdata('percent',$config['percent']);
						//redirect(base_url('mailing/progress'));
						if (!$result){
							$not_sent[]= $value;
						}
					}
				if (count($not_sent)==0){
					$this->session->set_flashdata('success','Wszystkie maile wysłano pomyślnie');
					redirect(base_url('mailing'));
				}
				else{
					$config['view'] = 'mailing/not_sent';
					$config['not_sent']=$not_sent; 
					$this->load->view('templates/content',$config);
				}
				
			}
			else{
				$this->session->set_flashdata('error','Nie udało się wczytać adresów klientów');
				redirect(base_url('mailing'));
			}
		}
		else{
			$this->session->set_flashdata('error','Nie udało się wczytać konfiguracji poczty');
			redirect(base_url('mailing'));
		}
		//echo $this->email->print_debugger();
	}
	
	public function progress(){
		$config['view'] = 'mailing/progress';
		$this->load->view('templates/content',$config);
	}
}