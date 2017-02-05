<?php 
echo '<h2>Edytuj ofertę</h2>';
if ($this->session->flashdata('last_post')) {
	$offers_array = $this->session->flashdata('last_post');
}

$sal = array();
foreach ($categories as $key=>$value){
	$sal[$value['category_id']] = $value['category_name'];
}

foreach ($offer as $key){
echo form_open('offers/update_offer/'.$key['offer_id']);
$name= array('name'=>'offer_name', 'value'=>  !empty($offers_array['offer_name']) ?$offers_array['offer_name']:$key['offer_name']);
$price = array('name'=>'offer_price', 'value'=> !empty($offers_array['offer_price']) ?$offers_array['offer_price']:$key['offer_price']);
$points = array('name'=>'offer_points', 'value'=> !empty($offers_array['offer_points']) ?$offers_array['offer_points']:$key['offer_points']);
$points_price= array('name'=>'offer_points_price', 'value'=> !empty($offers_array['offer_points_price']) ?$offers_array['offer_points_price']:$key['offer_points_price']);
$min_t = array('name'=>'offer_min_time', 'value'=> !empty($offers_array['offer_min_time']) ?$offers_array['offer_min_time']:$key['offer_min_time']);
$max_t = array('name'=>'offer_max_time', 'value'=> !empty($offers_array['offer_max_time']) ?$offers_array['offer_max_time']:$key['offer_max_time']);


echo '<table>';
echo '<tr><td>Kategoria*: </td><td>'.form_dropdown('offer_category', $sal, !empty($offers_array['offer_category']) ?$offers_array['offer_category']:$key['offer_category']).'</td></tr>';
echo '<tr><td>Nazwa*: </td><td>'. form_input($name).'</td></tr>' ;
echo '<tr><td>Cena*: </td><td>'. form_input($price).'zł</td></tr>' ;
echo '<tr><td>Punkty: </td><td>'. form_input($points).'</td></tr>';
echo '<tr><td>Koszt punktów: </td><td>'. form_input($points_price).'</td></tr>';
echo '<tr><td>Czas min: </td><td>'. form_input($min_t).'minut</td></tr>';
echo '<tr><td>Czas max: </td><td>'. form_input($max_t).'minut</td></tr>';
echo '</table>';
echo form_submit('submit','Zmień');
echo form_close();
echo 'Pola oznaczone przez gwiazdkę * są wymagane</br>';
}
?>