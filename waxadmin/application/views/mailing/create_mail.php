<?php echo '<h2>Nowy E-mail</h2>';

echo form_open(base_url('mailing/send'));

$subject = array('name'=>'subject','placeholder'=>'Temat');
$content = array('name'=>'content','placeholder'=>'Treść');
$foreigner1 = array('name'=>'client_foreigner','value'=>0, 'checked'=>TRUE);
$foreigner2 = array('name'=>'client_foreigner','value'=>1);

echo form_input($subject).'</br>';
echo form_textarea($content).'</br>';
echo 'Polskojęzyczni '.form_radio($foreigner1).' Angielskojęzyczni'.form_radio($foreigner2);
echo form_submit('submit','Wyślij');
echo form_close();
echo 'PAMIĘTAJ: Jeżeli panel administratora działa na tym samym serwerze co panel pracownika, nie jest wskazane wysyłanie mailingu w czasie pracy salonu. Mailing obciąża serwer co zwiększa ryzyko zawieszenia go. ';
?>