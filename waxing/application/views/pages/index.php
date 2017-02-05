	<div id="body">
		<h2>Trwające wizyty</h2>
		<a href="<?php echo base_url('visits');?>">Nowa wizyta</a>
		<table>
		<?php
		if($visits){
				foreach ($visits as $value){		
				echo '<h4>'.$value['client_name'].' '.$value['client_surname'].'</h4>';
				
				 //Imię i nazwisko pracownika, przewidywany czas zakończenia (min, max)
				echo 'Pracownik: '.$value['visit_worker_n'].'</br>';
				echo 'Liczba zabiegów: '.$value['visit_proced_num'].'</br>';
				echo 'Czas rozpoczęcia: '.$value['visit_start'].'</br>';
				$minsum =strtotime($value['visit_start'])+$value['visit_min_time']*60;
				$maxsum =strtotime($value['visit_start'])+$value['visit_max_time']*60;
				echo 'Minimalny czas zakończenia: '.date('H:i:s',$minsum).'</br>';
				echo 'Maksymalny czas zakończenia: '.date('H:i:s',$maxsum).'</br>';
				
				echo '<a href="'.base_url('visits/edit_visit/'.$value['visit_id']).'">Zarządzaj</a>';
					
				}
		}
		else{
			echo "Brak rozpoczętych wyzyt.";
		}
		?>
		</table>
		</div>