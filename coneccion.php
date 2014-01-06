<?php
	$link = mysql_connect('localhost','root') or die('No se pudo conectar:' . mysql_error());
	mysql_select_db('test') or die('Problemas al seleccionar la DB');
	mysql_query('SET CHARACTER SET utf8');
?>