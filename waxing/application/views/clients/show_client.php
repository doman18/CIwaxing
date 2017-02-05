<?php 
if ($client) {
	foreach ($client as $key) {
		echo '<h3>'.$key['client_name'].' '.$key['client_surname'].' Nr:'.$key['client_number'].' <a href="'.base_url('clients/edit_client/'.$key['client_id']).'">Edytuj</a></h3>';


		 echo 'Data rejestracji: '.$key['client_regdate'].'</br>';
		 echo 'Zebrane punkty: '.$key['client_points'].'</br>';
		 echo 'Licznik wizyt: '.$key['client_visit_count'].' ';
		 echo 'Suma wizyt: '.$key['client_visit_sum'].' ';
		 $av = $key['client_visit_count']? $key['client_visit_sum']/$key['client_visit_count']:0;
		 echo 'Średnia wizyt: '.$av.'</br>';
		 echo 'Newsletter: ';
		 echo $key['client_newsletter']?'TAK':'NIE';
		 if ($key['client_doubled']) {
		 	echo '<span style="color:red"><br>Istnieje klient o tym samym imieniu i nazwisku.<br> Aby uniknąć kłopotów z rozpoznawaniem dodaj pytanie wyróżniające wymyślone przez klienta w panelu edycji.</br></span>';
		 }
		 echo '</br></br>Wyróżnik:<br>';
		 if ($note) {
		 	foreach ($note as $key1){
		 		echo $key1['note_content'];
		 	}
		 	
		 }
		 
	}
	echo '</br></hr>';
	echo '<h3>Wizyty</h3>';
}
else {
	echo "Brak takiego użytkownika w bazie";
}
?>