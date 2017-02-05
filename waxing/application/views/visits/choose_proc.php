<?php 
echo '<div id="client_belt">';
foreach ($client as $value){
echo '<h2>'.$value['client_name'].' '.$value['client_surname'].'</h2>'; //@todo doman - jeżeli client_visit_count >= (wartość_ustalona w oknie admina+1) -> świeć się na czerwono. 
//dodać resztę danych klieta
echo '</div>';
echo form_open(base_url('visits/add_visit'));
		foreach ($categories as $value2){
			echo '<h3>'.$value2['category_name'].'</h3>';
				if ($offers){
					foreach ($offers as $value3){
							if ($value2['category_id']==$value3['offer_category']) {
								echo form_checkbox(array('name'=>$value3['offer_id'], 'value'=>$value3['offer_name'].'^'.$value3['offer_price'].'^'.$value3['offer_points_price'].'^'.$value3['offer_min_time'].'^'.$value3['offer_max_time'])).' '.$value3['offer_name'].' '.$value3['offer_price'].'</br>';
							}
					}
				}
				else {
					echo 'Brak ofert do wyświetlenia';
					
				}
		}

$worker = array('name'=>'worker_number');
$hidden = array('visit_client'=>$value['client_id']);
$hidden2 = array('client_number'=>$value['client_number']);
echo form_hidden($hidden);
echo form_hidden($hidden2);
echo '<br>Numer pracownika'.form_input($worker).'</br>';
echo form_submit('submit','Zatwierdź');
echo form_close();
}
?>