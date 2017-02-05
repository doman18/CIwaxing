<?php 
/*
 * Dane przekazane z kontrolera visits:
 * $visits
 * $client
 * $categories
 * $offers
 * 
 */
echo '<div id="client_belt">';
 //@todo doman - dodać funkcję promocyjne. 
echo '<h4>'.$visit[0]['client_name'].' '.$visit[0]['client_surname'].' NR: '.$visit[0]['client_number'].'</h4>';
echo '</div>'; //wyświetlić dane klienta odnośnie promocji. Zarówno tutaj jak i w dodawaniu wizyty

echo 'Pracownik: '.$visit[0]['visit_worker_n'].'</br>';
echo 'Liczba zabiegów: '.$visit[0]['visit_proced_num'].'</br>';
echo 'Czas rozpoczęcia: '.$visit[0]['visit_start'].'</br>';
$minsum =strtotime($visit[0]['visit_start'])+$visit[0]['visit_min_time']*60;
$maxsum =strtotime($visit[0]['visit_start'])+$visit[0]['visit_max_time']*60;
echo 'Minimalny czas zakończenia: '.date('H:i:s',$minsum).'</br>';
echo 'Maksymalny czas zakończenia: '.date('H:i:s',$maxsum).'</br></br>';

echo 'Całkowity koszt zabiegów: '.$visit[0]['visit_proced_sum'].'zł</br>'; //odjąć od sumy odjęty zabieg

echo form_open(base_url('visits/update_visit/'.$visit[0]['visit_id']));
		foreach ($categories as $value2){
			echo '<h3>'.$value2['category_name'].'</h3>';
				if ($offers){
					//tutaj walnąć funkcje do promocji. Przekazać postem hiddena z id oferty i jej ceną
					foreach ($offers as $value3){
							$checkbox_arr =array('name'=>$value3['offer_id'], 'value'=>$value3['offer_name'].'^'.$value3['offer_price'].'^'.$value3['offer_points_price'].'^'.$value3['offer_points'].'^'.$value3['offer_min_time'].'^'.$value3['offer_max_time'] );
							if ($value2['category_id']==$value3['offer_category']) {
								foreach ($visit as $value4){ // w każdej ofercie sprawdzaj wszystkie wybrane poprzednio zabiegi ($visit zawiera powielone dane wizyty według wybranych zabiegów) ...
									
									if ($value4['offer_id']==$value3['offer_id']){ //... sprawdź czy ID aktualnie sprawdzanego poprzedniego zabiegu są równe ID aktualnie wyświetlanej oferty
										$checkbox_arr['checked'] = 'checked';
										$checkbox_arr['value'] .= '^2'; // dodatkowa wartość tablicy oznaczająca potwierdzenie poprzedniego wybóru
									} else{
										$checkbox_arr['value'] .= '^3'; // dodatkowa wartość tablicy wskazująca na nowy wybór
									}
									
								}
								echo form_checkbox($checkbox_arr).' '.$value3['offer_name'].' '.$value3['offer_price'].'zł</br>';
							}
					}
				}
				else {
					echo 'Brak ofert do wyświetlenia';
					
				}
		}

		
		
$this->session->set_userdata($visit[0]);
$worker = array('name'=>'worker_password');
$hidden = array('visit_stop'=>date('H:i:s'));
$hidden2 = array('client_id'=>$client[0]['client_id']);
echo form_hidden($hidden);
echo form_hidden($hidden2);
echo '<br>Hasło pracownika'.form_password($worker).'</br>';
echo form_submit('submit','Zatwierdź');
echo form_close();

?>