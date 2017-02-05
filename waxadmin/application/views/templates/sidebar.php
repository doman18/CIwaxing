<div id="sidebar">
	<h3>Szukaj osoby</h3>
	<form action="<?php echo base_url('main/find_person');?>">
	<input type="text" name="person_number" placeholder="Numer">
	<input type="text" name="person_name" placeholder="Imię">
	<input type="text" name="person_surname" placeholder="Nazwisko">
	
	<input type="submit" value="Szukaj" formmethod="post">
	</form>
	</hr>
	<ul>
	<li><a href="<?php echo base_url('main')?>">Statystyki</a></li>
	<li><a href="<?php echo base_url('clients')?>">Klienci</a></li>
	<li><a href="<?php echo base_url('workers')?>">Pracownicy</a></li>
	<li><a href="<?php echo base_url('offers')?>">Oferty</a></li>
	<li><a href="<?php echo base_url('main/generator')?>">Generator numerów</a></li>
	</br>
	<li><a href="<?php echo base_url('mailing')?>">Mailing</a></li>
	</br>
	<li><a href="<?php echo base_url('main/logout')?>">Wyloguj</a></li>
	</ul>
	</div>