<?php 
echo '<h2>Edytuj pracownika</h2>';
if ($this->session->flashdata('last_post')) {
	$workers_array = $this->session->flashdata('last_post');
}

$sal = array();
foreach ($salons as $key=>$value){
	$sal[$value['salon_id']] = $value['salon_name'];
}

foreach ($worker as $key){
echo form_open('workers/update_worker/'.$key['worker_id']);
$number = array('name'=>'worker_number', 'value'=> !empty($workers_array['worker_number']) ?$workers_array['worker_number']:$key['worker_number']);
$name= array('name'=>'worker_name', 'value'=>  !empty($workers_array['worker_name']) ?$workers_array['worker_name']:$key['worker_name']);
$surname = array('name'=>'worker_surname', 'value'=> !empty($workers_array['worker_surname']) ?$workers_array['worker_surname']:$key['worker_surname']);
$mail = array('name'=>'worker_mail', 'value'=> !empty($workers_array['worker_mail']) ?$workers_array['worker_mail']:$key['worker_mail']);
$phone = array('name'=>'worker_phone', 'value'=> !empty($workers_array['worker_phone']) ?$workers_array['worker_phone']:$key['worker_phone']);
$address = array('name'=>'worker_address', 'value'=> !empty($workers_array['worker_address']) ?$workers_array['worker_address']:$key['worker_address']);
$password = array('name'=>'worker_password', 'value' => $key['worker_password']);
}

echo '<table>';
echo '<tr><td>Numer*: </td><td>'. form_input($number).' dodać zmienną z licznika jako sugerowana</td></tr>';
echo '<tr><td>Salon*: </td><td>'.form_dropdown('worker_place', $sal, !empty($workers_array['worker_place']) ?$workers_array['worker_place']:$key['worker_place']).'</td></tr>';
echo '<tr><td>Imię*: </td><td>'. form_input($name).'</td></tr>' ;
echo '<tr><td>Nazwisko*: </td><td>'. form_input($surname).'</td></tr>' ;
echo '<tr><td>Email: </td><td>'. form_input($mail).'</td></tr>';
echo '<tr><td>Telefon: </td><td>'. form_input($phone).'</td></tr>';
echo '<tr><td>Adres: </td><td>'. form_textarea($address).'</td></tr>';
echo '<tr><td>Hasło: </td><td>'. form_input($password).'</td></tr>';
echo '</table>';
echo form_submit('submit','Dodaj');
echo form_close();
echo 'Pola oznaczone przez gwiazdkę * są wymagane</br>';

?>