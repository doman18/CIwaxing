<?php 
echo '<h3>Panel klientów</h3>';
echo '<h4><a href="'.base_url('clients/add_client').'">Dodaj klienta</a></h4>';
if ($clients) {
	foreach ($clients as $key) {
		echo $key['client_doubled']?'<span style="color:red">':'';
		echo $key['client_name'].' '.$key['client_surname'].' Nr: '.$key['client_number'].' Tel: '.$key['client_phone'].' ostatnia wizyta: 2013-07-29';
		echo $key['client_doubled']?'</span>':'';
		echo ' <a href="'.base_url('clients/show_client/'.$key['client_id']).'">Profil</a> <a href="'.base_url('clients/edit_client/'.$key['client_id']).'">Edytuj</a> <a href="'.base_url('clients/delete_client/'.$key['client_id']).'">Usuń</a><hr>';
	}
}
else {
	echo "Brak wyników do wyświetlenia";
}
?>