<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<title>Panel administracyjny</title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('css/styl.css'); ?>" media="all" />
</head>
<body>

<div id="container">
	<div id="header"><h1>To jest naglowek z logiem</h1></div>

	<div id="body">
		<?php
		echo 'To jest główny panel';
		
		?>
		</div>
	<div id="sidebar">
	To jest sidebar
	</div>

	<div id="footer"><p>Page rendered in <strong>{elapsed_time}</strong> seconds</p>

	</div>
</div>


</body>
</html>