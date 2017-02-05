<?php 
if ($worker) {
	foreach($worker as $key){
		echo 'Czy na pewno chcesz usunąć pracownika '.$key['worker_name'].' '.$key['worker_surname'].' z listy pracowników?<br>';
		echo 'Cofnięcie operacji nie będzie możliwe!<br><br>';
		echo '<a href="'.base_url('workers/erase_worker/'.$key['worker_id']).'" style="color:red">&lt;USUŃ&gt;</a> <a href="'.base_url('workers').'" style="color:blue">&lt;ANULUJ&gt;</a>';
	}
}else {
	echo 'Brak takiego pracownika w bazie';
}
?>