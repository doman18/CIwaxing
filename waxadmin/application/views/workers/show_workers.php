<?php 
echo '<h3>Panel pracowników</h3>';
echo '<h4><a href="'.base_url('workers/add_worker').'">Dodaj pracownika</a></h4>';
if ($workers) {
	foreach ($salons as $key1){
		echo '<h2>'.$key1['salon_name'].'</h2>';
		foreach ($workers as $key) {
			if($key['worker_place']==$key1['salon_id']){
				echo $key['worker_name'].' '.$key['worker_surname'].' Nr:'.$key['worker_number'].' Tel: '.$key['worker_phone'].' ';
				echo ' <a href="'.base_url('workers/show_worker/'.$key['worker_id']).'">Profil</a> <a href="'.base_url('workers/edit_worker/'.$key['worker_id']).'">Edytuj</a> <a href="'.base_url('workers/delete_worker/'.$key['worker_id']).'">Usuń</a><hr>';
			}
		}
	echo 'Ilość obsłużonych klientek w ostatnich 10 dniach';
	}
}
else {
	echo "Brak wyników do wyświetlenia";
}
?>