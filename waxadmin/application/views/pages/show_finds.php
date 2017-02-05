<?php 
echo '<h3>Klienci</h3>';
if ($clients) {
	foreach ($clients as $key) {
		echo $key['client_name'].' '.$key['client_surname'].' Nr: '.$key['client_number'].' Tel: '.$key['client_phone'].' ostatnia wizyta: 2013-07-29';
		echo ' <a href="'.base_url('clients/show_client/'.$key['client_id']).'">Profil</a> <a href="'.base_url('clients/edit_client/'.$key['client_id']).'">Edytuj</a> <a href="'.base_url('clients/delete_client/'.$key['client_id']).'">Usuń</a><hr>';
	}
}
else {
	echo "Brak wyników do wyświetlenia";
}

echo '<h3>Pracownicy</h3>';
if ($workers) {

	foreach ($workers as $key) {
		
			echo $key['worker_name'].' '.$key['worker_surname'].' Nr:'.$key['worker_number'].' Tel: '.$key['worker_phone'].' ';
			echo ' <a href="'.base_url('workers/show_worker/'.$key['worker_id']).'">Profil</a> <a href="'.base_url('workers/edit_worker/'.$key['worker_id']).'">Edytuj</a> <a href="'.base_url('workers/delete_worker/'.$key['worker_id']).'">Usuń</a><hr>';

	}
	
}
else {
	echo "Brak wyników do wyświetlenia";
}
?>