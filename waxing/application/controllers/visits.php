<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visits extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('visits_model');
	}
	
	public function index(){
		$config['view']= 'visits/new_visit';
		$this->load->view('templates/content',$config);
	}
	
	public function show_visit(){
		$visit_id= $this->uri->segment(3);
		$config['visit'] = $this->visits_model->get_visit($visit_id);
		$config['view'] = 'visits/edit_visit';
		$this->load->view('templates/content',$config);
	}
	
	public function show_visit_set(){
		$visit_id= $this->uri->segment(3);
		$config['visit'] = $this->visits_model->get_visit($visit_id);
		$config['offer_set']= $this->uri->segment(4);
		$config['view'] = 'visits/edit_visit';
		$this->load->view('templates/content',$config);
	}
	
	public function add_visit(){
		$visit_arr['visit_client']=$this->input->post('visit_client');
		$worker = $this->visits_model->get_worker_v($this->input->post('worker_number'));
		
		if($worker){
				$visit_arr['visit_place'] = $worker[0]['worker_place'];
				$visit_arr['visit_worker'] = $worker[0]['worker_id'];
				$visit_arr['visit_worker_n'] = $worker[0]['worker_name'].' '.$worker[0]['worker_surname'];
				$visit_arr['visit_start'] = date('H:i:s');
				$visit_arr['visit_cdate'] = date('Y-m-d');
				
				$visit_arr['visit_proced_sum'] = 0;
				$visit_arr['visit_proced_num'] = 0;
				$visit_arr['visit_min_time'] = 0;
				$visit_arr['visit_max_time'] = 0;
				
					foreach ($this->input->post() as $key=>$value) //wczytuję całą tablicę post
					{
						if ($key=='visit_client') break; //jeżeli trafię na klucz o nazwie visit_client to znaczy że skończyło się sprawdzanie ofert i zaczeła się reszta tablicy
						$string = explode('^', $value);
						$offers[]=array('id'=>$key,'name'=>$string[0]);
						$visit_arr['visit_proced_sum'] += $string[1];
						++$visit_arr['visit_proced_num'];
						$visit_arr['visit_min_time'] += $string[3];
						$visit_arr['visit_max_time'] += $string[4];
					}
				
				$this->visits_model->instert_all($visit_arr,$offers);
				
					
			}
				
		
		else{
			$this->session->set_flashdata('error','Nie ma takiego pracownika w bazie danych. Sprawdź poprawność wprowadzonego numeru');
			$this->session->set_userdata('client_number',$this->input->post('client_number'));
			redirect(base_url('main/client_exists'));
		}
	}
	
	/* 
	 * offer ID
	* worker_number -> uzyskać workera z wybrania z bazy
	* client_data
	*
	visit_client -> przesłać Id przez hidden post
	
	uzyskać dane workera
	visit_place -> worker_place
	visit_worker -> wziąć z uzyskanego workera ID
	visit_worker_n -> wziąć z uzyskanego workera imię i nazwisko i przesłać przez hidden post
	visit_start -> uzyskane z time()
	visit_cdate -> uzyskana z date()
	
	w pętli uzyskiwać wartości zabiegów na podstawie offer_id (walnąć breaka jak dojdzie do innych niż id){
	visit_proced_num - policzyć ilość wystąpień offer ID
		
	visit_proced_sum - sumować kasę za całość
	sumować potrzebny czas
	sumować zdobyte punkty
		
	}
	
	
	
	
	insert visit
	
	wyjąć id dodanej wizyty i dodać do proced_visit
	
	insertować odpowiednie dane do tabeli zabiegów \|/
	proced_visit
	proced_offer
	proced_change - >1 (odjęty - nadawany na samym początku)
		
	
	
	
	
	*
	*/
	
	public function verify_worker(){
		$config['view']= 'visits/verify_w';
		$this->load->view('templates/content',$config);
	}
	
	public function edit_visit(){
		$this->load->model('main_model');
		$visit_id= $this->uri->segment(3);
		$config['visit'] = $this->visits_model->get_visit($visit_id);
		$config['client'] = $this->main_model->show_client($config['visit'][0]['visit_client']);
		$gender = $config['client'][0]['client_gender'];
		$config['categories']=$this->visits_model->get_categories($gender);
		$config['offers']=$this->visits_model->get_offers();
		$config['view'] = 'visits/edit_visit';
		$this->load->view('templates/content',$config);
				
			
			
			
	}
	
	public function update_visit(){
		$arr = $this->session->all_userdata(); 
		$int=0;
		foreach ($arr as $key=>$value){ //pozbywam się początkowej i końcowej tablicy sesji, pozostawiając tylko tablicę wizyty.
			if ($key == 'visit_id') $int = 1;
			if ($int == 1) $visit[$key]=$value;
			if ($key == 'offer_max_time') $int = 0;
						
		}
		$this->session->unset_userdata($visit); //potrzebne dane mam już w $visit_arr więc usuwam dane z sesji posługując się posiadaną już tablicą w celu wskazania które dane mają zostać usunięte
		
		$worker = $this->visits_model->get_workerm($visit['visit_worker']);
		$password = $this->input->post('worker_password');
		if ($password == $worker[0]['worker_password']){ //@todo doman dodać && admin_password albo po prostu stringa zwykłego
			$visit_arr['visit_stop'] = $this->input->post('visit_stop');
			$visit_time = round((strtotime($visit_arr['visit_stop'])-strtotime($visit['visit_start']))/60);
			
			$visit_arr['visit_proced_sum'] = 0;
			$visit_arr['visit_proced_num'] = 0;
			$visit_arr['visit_min_time'] = 0;
			$visit_arr['visit_max_time'] = 0;
			$points = 0;
			
			foreach ($this->input->post() as $key=>$value) //wczytuję całą tablicę post
			{
				if ($key=='visit_stop') break; //jeżeli trafię na klucz o nazwie visit_stop to znaczy że skończyło się sprawdzanie ofert i zaczeła się reszta tablicy
				$string = explode('^', $value);
				$offers[]=array('id'=>$key,'name'=>$string[0], 'change'=>$string[6]);
				$visit_arr['visit_proced_sum'] += $string[1];
				++$visit_arr['visit_proced_num'];
				$points += $string[3];  //tym razem dodaję zliczanie punktów
				$visit_arr['visit_min_time'] += $string[4];
				$visit_arr['visit_max_time'] += $string[5];
			}
			
			if ($visit_time>$visit_arr['visit_max_time']) {
				$visit_arr['visit_time_diff'] = (int)($visit_time - $visit_arr['visit_max_time']);
			}
			elseif ($visit_time<$visit_arr['visit_min_time']){
				$visit_arr['visit_time_diff'] = (int)($visit_time - $visit_arr['visit_min_time']);
			}
			else {
				$visit_arr['visit_time_diff'] = 0;
			}
			
			$this->visits_model->update_all($visit['visit_id'],$visit['client_id'],$visit_arr,$offers,$points);
			var_dump($visit);
			}
			else{
			$this->session->set_flashdata('error','Niepoprawne hasło');
					//@todo doman wrzucić funkcję opóźniającą opartą na sesji
			redirect(base_url('visits/edit_visit/'.$visit_arr['visit_id'])) ;
			}
			
			/*UPDATE
			proced_change 2 (potwierdzony - nadawany przy potwierdzeniu jeżeli istniała wartość), 3 (dodany, nadawany jako nowy)
			visit_stop => już w formularzu uzyskać tą wartość i później przesłać ją hiddenem
			visit_time_diff ->visit_stop - visit_start - suma potrzebnego czasu
			podliczyć punkty i dodać je do klienta. Doliczyć wyzytę do licznika, obliczyć średnią wizyt i dodać do klienta
				
			przed update znów się zapytać o login pracownika
		*/
	}
		
}
		
		
