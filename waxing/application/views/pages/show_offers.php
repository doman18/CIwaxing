<?php 
echo '<h3>Panel ofert</h3>';
if ($offers) {
	foreach ($categories as $key1){
		echo '<h2>'.$key1['category_name'].'</h2>';
		foreach ($offers as $key) {
			if($key['offer_category']==$key1['category_id']){
				echo $key['offer_name'].' Cena: '.$key['offer_price'].'zł Punkty:'.$key['offer_points'].' Koszt pkt: '.$key['offer_points_price'].' Czas min: '.$key['offer_min_time'].' Czas max: '.$key['offer_max_time'].'</br>';
				
			}
		}
	}
}
else {
	echo "Brak wyników do wyświetlenia";
}
?>