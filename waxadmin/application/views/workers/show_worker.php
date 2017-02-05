<?php 
if ($worker) {
	foreach ($worker as $key) {
		echo '<h3>'.$key['worker_name'].' '.$key['worker_surname'].' Nr:'.$key['worker_number'].' <a href="'.base_url('workers/edit_worker/'.$key['worker_id']).'">Edytuj</a> <a href="'.base_url('workers/delete_worker/'.$key['worker_id']).'">Usuń</a></h3>';

		 echo 'Telefon: '.$key['worker_phone'].'</br>';
		 echo 'Email: '.$key['worker_mail'].'</br>';
		 echo 'Adres '.$key['worker_address'].'</br></br>';
		 echo 'Hasło: '.$key['worker_password'].'</br>';
		 echo 'Data rejestracji: '.$key['worker_regdate'].'</br>';

	}
	echo '</br></hr>';
	echo '<h3>Wizyty</h3>';
}
else {
	echo "Brak takiego pracownika w bazie";
}
?>