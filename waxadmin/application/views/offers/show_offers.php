<?php 
echo '<h3>Panel ofert</h3>';
echo '<h4><a href="'.base_url('offers/cat_mgmt').'">Zarządzaj kategoriami</a></h4>';
echo '<h4><a href="'.base_url('offers/add_offer').'">Dodaj ofertę</a></h4>';
if ($offers) {
	foreach ($categories as $key1){
		echo '<h2>'.$key1['category_name'].' <a href="'.base_url('offers/cat_mgmt').'">Zmień</a></h2>';
		foreach ($offers as $key) {
			if($key['offer_category']==$key1['category_id']){
				echo $key['offer_name'].' Cena: '.$key['offer_price'].'zł Punkty:'.$key['offer_points'].' Koszt pkt: '.$key['offer_points_price'].' Czas min: '.$key['offer_min_time'].' Czas max: '.$key['offer_max_time'].' ';
				echo '<a href="'.base_url('offers/edit_offer/'.$key['offer_id']).'">Edytuj</a> <a href="'.base_url('offers/delete_offer/'.$key['offer_id']).'">Usuń</a><hr>';
			}
		}
	}
}
else {
	echo "Brak wyników do wyświetlenia";
}
?>