<?php 
echo '<h2>Edytuj klienta</h2>';
if ($this->session->flashdata('last_post')) {
	$clients_array = $this->session->flashdata('last_post');
	$client_question = $this->session->flashdata('client_question');
}
foreach ($client as $key){
echo form_open('clients/update_client/'.$key['client_id']);
$number = array('name'=>'client_number', 'value'=> !empty($clients_array['client_number']) ?$clients_array['client_number']:$key['client_number']);
$name= array('name'=>'client_name', 'value'=>  !empty($clients_array['client_name']) ?$clients_array['client_name']:$key['client_name']);
$surname = array('name'=>'client_surname', 'value'=> !empty($clients_array['client_surname']) ?$clients_array['client_surname']:$key['client_surname']);
$mail = array('name'=>'client_mail', 'value'=> !empty($clients_array['client_mail']) ?$clients_array['client_mail']:$key['client_mail']);
$phone = array('name'=>'client_phone', 'value'=> !empty($clients_array['client_phone']) ?$clients_array['client_phone']:$key['client_phone']);
$address = array('name'=>'client_address', 'value'=> !empty($clients_array['client_address']) ?$clients_array['client_address']:$key['client_address']);
$password = array('name'=>'client_password', 'value' => $key['client_password']);
$newsletter = array('name'=>'client_newsletter', 'value'=>1, 'checked'=> !empty($clients_array['client_newsletter']) ?$clients_array['client_newsletter']:$key['client_newsletter']);
$points = array('name'=>'client_points', 'value'=> !empty($clients_array['client_points']) ?$clients_array['client_points']:$key['client_points']);
$counter = array('name'=>'client_visit_count', 'value'=> !empty($clients_array['client_visit_count']) ?$clients_array['client_visit_count']:$key['client_visit_count']);
$sum = array('name'=>'client_visit_sum', 'value'=> !empty($clients_array['client_visit_sum']) ?$clients_array['client_visit_sum']:$key['client_visit_sum']);
$question = array('name'=>'client_question', 'value'=> !empty($client_question) ? $client_question : '');
$foreigner1 = array('name'=>'client_foreigner','value'=>0);
$foreigner2 = array('name'=>'client_foreigner','value'=>1);

if (!empty($clients_array['client_foreigner'])){
	if ($clients_array['client_foreigner'] == 0) $foreigner1['checked']=TRUE;
	elseif ($clients_array['client_foreigner'] == 1) $foreigner2['checked']=TRUE;
}
else{
	if ($key['client_foreigner'] == 0) $foreigner1['checked']=TRUE;
	elseif ($key['client_foreigner'] == 1) $foreigner2['checked']=TRUE;
	}
}


$sal = array('0'=>'Kobieta','1'=>'Mężczyzna');
echo '<table>';
echo '<tr><td>Numer*: </td><td>'. form_input($number).' dodać zmienną z licznika jako sugerowana</td></tr>';
echo '<tr><td>Imię*: </td><td>'. form_input($name).'</td></tr>' ;
echo '<tr><td>Nazwisko*: </td><td>'. form_input($surname).'</td></tr>' ;
echo '<tr><td>Płeć*: </td><td>'.form_dropdown('client_gender', $sal, !empty($clients_array['client_gender']) ?$clients_array['client_gender']:$key['client_gender']).'</td></tr>';
echo '<tr><td>Język: </td><td>Polski '.form_radio($foreigner1).' Angielski'.form_radio($foreigner2).'</td></tr>';
echo '<tr><td>Email: </td><td>'. form_input($mail).'</td></tr>';
echo '<tr><td>Telefon: </td><td>'. form_input($phone).'</td></tr>';
echo '<tr><td>Adres: </td><td>'. form_textarea($address).'</td></tr>';
echo '<tr><td>Hasło: </td><td>'. form_input($password).'</td></tr>';
echo '<tr><td>Newsletter: </td><td>'. form_checkbox($newsletter).'</td></tr>';
echo '<tr><td>Zebrane punkty: </td><td>'. form_input($points).'</td></tr>';
echo '<tr><td>Licznik wizyt: </td><td>'. form_input($counter).'(max 8)</td></tr>';
echo '<tr><td>Suma wizyt: </td><td>'. form_input($sum).'zł</td></tr>';
echo '<tr><td>Wyróżnik: </td><td>'. form_textarea($question).'</td></tr>';
echo '</table>';
echo form_submit('submit','Dodaj');
echo form_close();
echo 'Pola oznaczone przez gwiazdkę * są wymagane</br>';
echo 'Aby dodać punkty, liczbę wizyt lub sumę wizyt, po dodaniu użytkownika przejdź do panelu edycji</br></br>';
echo 'Wyróżnik nie jest normalnie wymagany. Staje się wymagany jeżeli dodawana osoba ma takie samo imie i nazwisko jak inna osoba istniejąca już w bazie. Treść wyróżnika musi dotyczyć rzeczy dobrze znajomej klientowi -tak aby klient zawsze mógł na nie poprawnie odpowiedzieć- i w jednoznaczny sposób go wyróżniającej - by nigdy nie było wątpliwości której osoby dotyczy</br>Przykłady wyróżników</br></br> ';
echo 'Imię pierwszej miłości:Tomek</br>';
echo 'Imię żony/męża/partnera(ki)/pierwszego dziecka/wnuka: Imię</br>';
echo 'Numer mieszkania: 5</br>';
echo 'Marka mojego samochodu(roweru/motocykla): Skoda Felicia</br>';
echo 'Zwierzątko domowe: pies Wacław</br>';
echo 'W pytaniu nie należy podawać żadnych informacji personalnych typu NIP, PESEL, nr rejestracji. Nie należy podawać też informacji zbyt ogólnych (płeć, ilość dzieci, dzielnica) ani takich dla których prawdopodobieństwo powtórzenia jest zbyt wysokie (ulubiony kolor, liczba, wykonywany zawód ) </br>';

?>