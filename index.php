<?php
	include 'coneccion.php';	
	header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Proyecto STEM UACH</title>
  
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
  <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
  
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>  
  <script type="text/javascript">
	  $(document).ready(function() {
		$(".f_registro").fancybox({  						
		  'width'				: 500,
		  'height'				: 300,
		  'autoScale'			: false,
		  'transitionIn'		: 'fade',
		  'transitionOut'		: 'fade',
		  'type'				: 'iframe',						
		});	
	  });	  
	  //funcion que verifica si el usuario existe 
	  function v_usuario(){
		  var use = $("#username").val();
		  var pas = $("#password").val();
		$.ajax({
			type: "POST",
			url: "ajax.php",
			data: "e_actividad=0&c_cuento=0&id_cuento=0&car_cue=0&id_cue=0&valores=0&c_curso=0&id_cur=0&regis=0&tutor=0&a_pat=0&a_mat=0&user=0&pass=0&v_us=1&us="+use+"&pa="+pas,
			success: function(datos){
				if(datos > 0){
					window.location.assign("http://stemuach.hol.es/main.php?idu="+datos);
				}
				else{
					alert('El usuario ingresado no existe');					
				}
			}
		});												
	  }
  </script>
</head>

<body>
<!--<div id="cabezera"></div>-->
<div id="contenedor">
    <div id="login">
     
        <h1>Inicio de Sesi&oacuten</h1>
        <div id="form_l" class="login-form">  
            <input type="text" id="username" name="username" placeholder="username">
            <input type="password" id="password" name="password" placeholder="password">
            <input type="button" value="Ingresar" onclick="v_usuario()">
            <div id="registro"><p>No estas registrado?</p><a id="registrar" class="f_registro" href="registro.php">Registrate</a></div>
        </div>      
    </div>
</div>
<div id="pie_pagina"></div>
</body>
</html>