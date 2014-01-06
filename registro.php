<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Proyecto STEM UACH</title>
  <!--<link rel="stylesheet" type="text/css" href="css/registro.css" />-->
  <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
  
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
	  //envio el registro del nuevo usuario para ingresarlo a la BD
	  function registrar_u(){
		  var tut = $("#n_tutor").val().trim();
		  var a_p = $("#apellido_p").val().trim();
		  var a_m = $("#apellido_m").val().trim();
		  var usr = $("#n_usuario").val().trim();
		  var con = $("#contrasena").val().trim();
		  var rcon = $("#r_contrasena").val().trim();
		  //si se ingresaron todos los campos solicitados
		  if(tut!="" && a_p!="" && a_m!="" && usr!="" && con!="" && rcon!=""){
			  //si las contraseñas son iguales registro al usuario
			  if(con == rcon){
				  //alert("son iguales")
				  $.ajax({
						  type: "POST",
						  url: "ajax.php",
						  data: "e_actividad=0&c_cuento=0&id_cuento=0&car_cue=0&id_cue=0&valores=0&c_curso=0&id_cur=0&regis=1&tutor="+tut+"&a_pat="+a_p+"&a_mat="+a_m+"&user="+usr+"&pass="+con,
						  success: function(datos){
							  alert(datos);
							  //$.fancybox.close();
						  }
				  });
			  }
			  //si las contraseñas son distintas
			  else{			  
				  alert("Error!!!! Las contraseñas son distintas");
				  $("#contrasena").val("");
				  $("#r_contrasena").val("");				  
			  }
		  }
		  //si falta uno o mas campos por llenar
		  else{
			  alert("Error!!!! Debe ingresar todos los campos solicitados");
		  }
	  }  		
  </script>
</head>

<body>
	<div id="contenido">
        <div id="d_tutor">
        	<p>Datos del tutor:</p>
            Nombre Tutor: <input type="text" id="n_tutor" name="n_tutor" size="25" maxlength="50">
            Apellido Paterno: <input type="text" id="apellido_p" name="apellido_p" size="35" maxlength="100">
            Apellido Materno: <input type="text" id="apellido_m" name="apellido_m" size="35" maxlength="100">
        </div>
        <div id="d_usuario">
        	<p>Datos de usuario:</p>
            Nombre de Usuario: <input type="text" id="n_usuario" name="n_usuario" size="35" maxlength="100">
            contrase&ntilde;a: <input type="password" id="contrasena" name="contrasena" size="15" maxlength="50">
            repita contrase&ntilde;a: <input type="password" id="r_contrasena" name="r_contrasena" size="15" maxlength="50">
 		</div><br/>
        <div id="e_registro"><input type="button" value="Registrame" onclick="registrar_u()"/></div>    
    </div>
</body>
</html>