<?php 
echo '<h3>Nie udało się wysłać wiadomości na następujące adresy</h3>';
$i = 0;
foreach ($not_sent as $value){
	echo $value.'<br/>';
	++$i;
	if ($i == 30){ //@todo doman ogranicznik wyświetlania. Zamienić na paginację
		echo '...';
		break;
	}
}
?>