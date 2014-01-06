<?php

include 'coneccion.php';
header('Content-Type: text/html; charset=UTF-8');

//creo la tabla con los alumnos correspondientes al curso seleccionado
if($_POST['c_curso'] == 1){
	$alumnos = mysql_query("SELECT * FROM alumno WHERE curso='".$_POST['id_cur']."'");	
	echo '
	<div class="curso_tabla">
	  <div class="curso_fila">
		  <div class="curso_izqcolumna tit_table">Nombres</div>
		  <div class="curso_dercolumna tit_table">Apellido Materno</div>
		  <div class="curso_dercolumna tit_table">Apellido Paterno</div>
		  <div class="curso_dercolumna tit_table">Asistencia</div>                
	  </div>';
	  while ($alumno=mysql_fetch_array($alumnos)){
		  echo'
		  <div class="curso_fila">
			  <div class="curso_izqcolumna">'.$alumno['nombre'].'</div>
			  <div class="curso_dercolumna">'.$alumno['apellido1'].'</div>
			  <div class="curso_dercolumna">'.$alumno['apellido2'].'</div>
			  <div class="curso_dercolumna"><input name="lista[]" type="checkbox" value="'.$alumno['id'].'" /></div>                
		  </div>';
	  }
	  echo'</div>';
}
//creo la tabla de actividades y almaceno los alumnos asistentes
if($_POST['e_actividad'] == 1){
	/*almacenar los alumnos asistentes*/
	$asistentes = str_split($_POST['valores']);
	$num_asist = count($asistentes);
	for($i=0;$i<$num_asist;$i++){
		mysql_query("UPDATE alumno SET asistencia=1 WHERE id='".$asistentes[$i]."'");
	}
	/*generamos la tabla de actividades*/
	$actividades = mysql_query("SELECT * FROM actividades");	
	echo '
	   <table width="300" border="1">
		<tr>
		  <td>Tipo de Actividad</td>
		  <td>Ver</td>
		</tr>';
		while ($actividad=mysql_fetch_array($actividades)){
			echo'		
				<tr>
				  <td>'.$actividad['tipo'].'</td>
				  <td><a id="ver_actividad" href="#" onclick="c_cuentos('.$actividad['id'].')"><img src="images/ver.png" width="20" height="18" border="0"/></a></td>
				</tr>';			             		
	  	}
	  echo'</table>';
}
//creo la tabla con la lista de cuentos
if($_POST['c_cuento'] == 1){
	$cuentos = mysql_query("SELECT * FROM cuentos WHERE actividad='".$_POST['id_cuento']."'");
	echo '
	   <table width="300" border="1">
		<tr>
		  <td>Nombre del Cuento</td>
		  <td>Ver</td>
		</tr>';
		while ($cuento=mysql_fetch_array($cuentos)){
			echo'		
				<tr>
				  <td>'.$cuento['nombre'].'</td>
				  <td>
				  	<a id="'.$cuento['id'].'" class="v_cuentos" href="cuentos.php?idcue='.$cuento['id'].'&video='.$cuento['video'].'&idcur='.$_POST['id_curso'].'">
						<img src="images/ver.png" width="20" height="18" border="0"/>
					</a>
				  </td>
				</tr>';			             		
	  	}
	  echo'</table>';	
}
//registro el nuevo usuario en la BD
if($_POST['regis'] == 1){
	mysql_query("INSERT INTO usuario (usuario,pass) VALUES ('".$_POST['user']."','".$_POST['pass']."')");
	$id_usuario = mysql_insert_id();
	mysql_query("INSERT INTO tutor (nombre,apellido1,apellido2,usuario) VALUES ('".$_POST['tutor']."','".$_POST['a_pat']."','".$_POST['a_mat']."','".$id_usuario."')");
	echo'Se ha registrado correctamente, ya puede iniciar sesión.';
}
if($_POST['v_us'] == 1){
	$query = mysql_query("SELECT * FROM usuario WHERE usuario='".$_POST['us']."' AND pass='".$_POST['pa']."'");
	$usuario = mysql_fetch_array($query);
	$num_fil = mysql_num_rows($query);
	if($num_fil < 1){
		//el usuario no existe
		echo '0';
	}
	else{
		//el usuario existe
		echo $usuario['id'];
	}
}
?>				