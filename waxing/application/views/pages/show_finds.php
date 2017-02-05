<?php 
echo '<h3>Klienci</h3>';
if ($clients) {
	foreach ($clients as $key) {
		echo $key['client_doubled']?'<span style="color:red">':'';
		echo $key['client_name'].' '.$key['client_surname'].' Nr: '.$key['client_number'].' ostatnia wizyta: 2013-07-29';
		echo $key['client_doubled']?'</span>':'';
		echo ' <a href="'.base_url('main/show_client/'.$key['client_id']).'">Profil</a> <a href="'.base_url('main/edit_client/'.$key['client_id']).'">Edytuj</a><hr>';
	}
}
else {
	echo "Brak wyników do wyświetlenia";
}
?>