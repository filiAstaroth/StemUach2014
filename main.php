<?php
	/**************************************************************************************/
	/*Autores:                                                                            */
	/*         Pamela Morales Moena                                                       */
	/*         Jose Luis Ramirez Barra                                                    */
	/*                                                                                    */
	/*Año    : 2013                                                                       */
	/**************************************************************************************/
	include 'coneccion.php';
	header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Proyecto STEM UACH</title>
  <link rel="stylesheet" type="text/css" href="css/main_style.css" />
  <link rel="stylesheet" type="text/css" href="css/botones.css" />
  <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
  
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>  
  <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

  <script type="text/javascript">
		$(document).ready(function(){
			//al presionar nuevo curso muestro el div para agregar un nuevo curso a la BD								   
			$("#btn_nuevoCurso").click(function(event){
				$("#nuevo_curso").show();
			})
			//agrego el nuevo curso a la BD y escondo el div
			$("#btn_agregarCurso").click(function(event){
				$("#nuevo_curso").hide();
			})
			//al presionar nuevo alumno muestro el div para agregar un nuevo alumno a la BD	
			$("#btn_nuevoAlumno").click(function(event){
				$("#d_actividades").hide();												 
				$("#nuevo_alumno").show();
			})
			//agrego el nuevo alumno a la BD y escondo el div
			$("#btn_agregarAlumno").click(function(event){
				$("#nuevo_alumno").hide();
			})			
		});
		var curso = "";
		//muestro la lista de alumnos asociado al curso seleccionado
		function c_alumnos(id_curso){
			$("#nuevo_curso").hide();
			curso = id_curso;			
			$("#d_cursos").hide();
			$("#d_lisAlumnos").show();
			//var id_curso = $("#ver_curso").attr("name");
			//alert(nombre);
			$.ajax({
					type: "POST",
					url: "ajax.php",
					data: "e_actividad=0&c_cuento=0&id_cuento=0&car_cue=0&id_cue=0&valores=0&regis=0&v_us=0&c_curso=1&id_cur="+id_curso,
					success: function(datos){
						//alert(datos);
						$("#alumnos_tabla").html(datos);
					}
			});												
		}
		//muestra la lista de actividades almacenadas en la BD
		function c_actividades(){
		  $("#nuevo_alumno").hide();													  
		  $("#d_actividades").show();
		  //obtenemos los valores de los checkbox
		  var valoresCheckbox = "";
		  $('input[name="lista[]"]:checked').each(function() {
			  valoresCheckbox += $(this).val() /*+ ","*/;
		  });		  
		  $.ajax({
				  type: "POST",
				  url: "ajax.php",
				  data: "c_curso=0&id_cur=0&c_cuento=0&id_cuento=0&car_cue=0&id_cue=0&regis=0&v_us=0&e_actividad=1&valores="+valoresCheckbox,
				  success: function(datos){
					  //alert(datos);
					  $("#actividades").html(datos);
					  //almacenar los checkbox con tick
				  }
		  });							
		}
		//muestra los cuentos asociados a la actividad cuentos
		function c_cuentos(actividad){
		  $("#desglose_actividades").hide();
		  $("#desglose_actividades").show();
		  $.ajax({
				  type: "POST",
				  url: "ajax.php",
				  data: "c_curso=0&id_cur=0&e_actividad=0&car_cue=0&id_cue=0&valores=0&regis=0&v_us=0&c_cuento=1&id_cuento="+actividad+"&id_curso="+curso,
				  success: function(datos){
					  //alert(datos);
					  $("#cuentos").html(datos);
					  $(".v_cuentos").fancybox({  						
						'width'				: 880,
						'height'			: 700,
						'autoScale'			: false,
						'transitionIn'		: 'fade',
						'transitionOut'		: 'fade',
						'type'				: 'iframe',						
					  });
				  }
		  });							
		}
		function c_canciones(){
			$("#desglose_actividades").hide();
		}
  </script>
</head>

<body>
  <div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.html">Proyecto STEM UACH</a></h1>
          <h2>Cuentos que no son puro cuento</h2>
        </div>
      </div>
      <nav>
      	<?php 
			$tutor = mysql_fetch_array(mysql_query("SELECT * FROM tutor WHERE usuario='".$_GET['idu']."'"));
		?>
      	<p id="usuario"><strong>Bienvenido(a): </strong> <?php echo $tutor['nombre']." ".$tutor['apellido1'];?></p>
      </nav>
    </header>
    <div id="site_content">
      <div class="content">
      	<div id="d_cursos">
            <h2>Mis Cursos</h2>
            <div class="curso_tabla">
                <div class="curso_fila">
                    <div class="curso_izqcolumna tit_table">
                        <strong>Nombre Curso</strong>
                    </div>
                    <div class="curso_dercolumna tit_table">
                        <strong>N° Alumnos</strong>
                    </div>
                    <div class="curso_dercolumna tit_table">
                        <strong>Ver Curso</strong>
                    </div>                
                </div>
                <?php
					//obtengo los cursos almacenados en la BD
					$lis_cursos = mysql_query("SELECT * FROM curso");					
					while($curso=mysql_fetch_array($lis_cursos)){
						$num_alumnos = count($curso);
						echo '
							  <div class="curso_fila">
								  <div class="curso_izqcolumna">'.$curso['nombre'].'</div>
								  <div class="curso_dercolumna">'.$num_alumnos.'</div>                    
								  <div class="curso_dercolumna">';?>
								  	<a id="ver_curso" name="" href="#" onclick="c_alumnos(<?php echo $curso['id'];?>)">
                            			<img src="images/ver.png" width="20" height="18" border="0"/> 
                        			</a><?php
								  echo'</div>
							  </div>';										
					}
				?>           
            </div>
            <div id="acciones_c" class="acciones">
                <p id="btn_nuevoCurso"><input type="button" value="Nuevo Curso" class="boton"/></p>                
            </div>
        </div>
        <div id="d_lisAlumnos" style="display:none">
        	<h2>Lista de Alumnos</h2>
        	<div id="alumnos_tabla">
				
            </div>
            <div id="acciones_a" class="acciones">
            	<p id="btn_nuevoAlumno"><input type="button" value="Nuevo Alumno" class="boton"/></p>
                <p id="btn_escogerActividad"><input type="button" value="Escoger Actividad" class="boton" onclick="c_actividades()"/></p>
            </div>
        </div>        
      </div>
    </div>
    
    <nav>
    </nav>
    <div id="nuevo_curso" style="display:none">
   	  <h2>Agregar Nuevos Cursos</h2>
      <table width="400">
            <tr>
                <td width="120"><strong>Nombre del Curso</strong></td>
                <td><input name="cur_nombre" id="cur_nombre" type="text" size="40"/></td>
            </tr>
      </table>
	  <p id="btn_agregarCurso"><input type="button" value="Agregar Curso" class="boton"/></p>
    </div>
    
    <div id="nuevo_alumno" style="display:none">
   	  <h2>Agregar Nuevos Alumnos</h2>
	  <table width="400">
          <tr>
            <td><strong>Nombres</strong></td>
            <td><strong>Apellido Paterno</strong></td>
            <td><strong>Apellido Materno</strong></td>
          </tr>
          <tr>
            <td><input name="alum_nombre" id="alum_nombre" type="text" /></td>
            <td><input name="alum_apellidoP" id="alum_apellidoP" type="text" /></td>
            <td><input name="alum_apellidoM" id="alum_apellidoM" type="text" /></td>
          </tr>
      </table>
	  <p id="btn_agregarAlumno"><input type="button" value="Agregar Alumno" class="boton"/></p>
    </div>
    
    <div id="d_actividades" style="display:none">
        <div id="lista_actividades" class="d_activity">
          <h2>Lista de Actividades</h2>
		  <div id="actividades">
          </div>		
          <p id="btn_agregarActividad"><input type="button" value="Agregar Actividad" class="boton"/></p>
        </div>
        <div id="desglose_actividades" class="d_activity" style="display:none">
          <h2>Lista de Cuentos</h2>
		  <div id="cuentos">
          </div>	
          <p id="btn_agregarCuento"><input type="button" value="Agregar Cuento" class="boton"/></p>
        </div>
        <div id="vacio"></div>
    </div>                   
  </div>
</body>
</html>