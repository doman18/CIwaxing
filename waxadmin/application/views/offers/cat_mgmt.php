<?php 
echo '<h4>Dodaj kategorię</h4>';
$sal = array('0'=>'Damska','1'=>'Męska');
$name=array ('name'=>'category_name', 'placeholder'=>'Nowa');
echo form_open(base_url('offers/insert_cat'));
echo 'Nazwa: '.form_input($name);
echo ' Płeć: '.form_dropdown('category_gender', $sal, '0').'</td></tr>';
echo form_submit('submit','Dodaj');
echo form_close();
echo 'Dodana kategoria automatycznie pojawi się w liście ofert jako nowy dział';

echo '<h4>Edytuj kategorie</h4>';

foreach ($categories as $key){
	$name=array ('name'=>'category_name', 'value'=>$key['category_name']);
	echo form_open(base_url('offers/update_cat/'.$key['category_id']));
	echo form_input($name);
	echo ' Płeć: '.form_dropdown('category_gender', $sal, $key['category_gender']).'</td></tr>';
	echo form_submit('submit','zmień').' <a href="'.base_url('offers/delete_cat/'.$key['category_id']).'">Usuń</a>';
	echo form_close();
}

?>