<div id="sidebar">
	<h3>Szukaj klienta</h3>
	<form action="<?php echo base_url('main/find_client');?>">
	<input type="text" name="client_number" placeholder="Numer">
	<input type="text" name="client_name" placeholder="Imię">
	<input type="text" name="client_surname" placeholder="Nazwisko">
	
	<input type="submit" value="Szukaj" formmethod="post">
	</form>
	</hr>
	<ul>
	<li><a href="<?php echo base_url('main')?>">Wizyty</a></li>
	<li><a href="<?php echo base_url('main/show_offers')?>">Aktualne oferty</a></li>
	<li><a href="<?php echo base_url('main/add_client')?>">Dodaj klienta</a></li>
	</br>
	<li><a href="<?php echo base_url('main/logout')?>">Wyloguj</a></li>
	</ul>
	</div>