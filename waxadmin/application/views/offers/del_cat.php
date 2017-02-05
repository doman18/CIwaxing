<?php 
if ($category) {
	foreach($category as $key){
		echo 'Czy na pewno chcesz usunąć kategorię '.$key['category_name'].' z listy kategorii?<br>';
		echo 'Cofnięcie operacji nie będzie możliwe!<br><br>';
		echo '<a href="'.base_url('offers/erase_cat/'.$key['category_id']).'" style="color:red">&lt;USUŃ&gt;</a> <a href="'.base_url('offers/cat_mgmt').'" style="color:blue">&lt;ANULUJ&gt;</a>';
	}
}else {
	echo 'Brak takiej kategorii w bazie';
}
?>