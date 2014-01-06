<?php 
	include 'coneccion.php';
	header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Proyecto STEM UACH</title>
  <link rel="stylesheet" type="text/css" href="css/main_style.css" />
  <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
  
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <script type="text/javascript" src="js/fancybox/jquery.easing-1.3.pack.js"></script>
  <script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
  <script type="text/javascript" src="js/jQuery.tubeplayer.min.js"></script>
  
  <script type="text/javascript">
  		//url del video a reproducir
  		var video = "<?php echo $_GET['video'];?>";		
		$(document).ready(function(){								   
			$("#reproductor").tubeplayer({
				width: 400, // the width of the player
				height: 250, // the height of the player
				allowFullScreen: "true", // true by default, allow user to go full screen
				initialVideo: video, // the video that is loaded into the player
				preferredQuality: "default",// preferred quality: default, small, medium, large, hd720
			});
			$("#btn_generarInforme").click(function(event){
				$("#form_1").hide();
				$("#form_2").show();
			});
			
		});	
  </script>		
</head>

<body>
	<div id="contenedor">
    	<div id="form_1">
            <div id="descripcion_c">
                <?php 
                    $cuento = mysql_fetch_array(mysql_query("SELECT * FROM cuentos WHERE id='".$_GET['idcue']."'"));
                ?>
                <table width="800" border="1">
                  <tr>
                    <td width="100">Nombre</td>
                    <td><?php echo "".$cuento['nombre']?></td>
                  </tr>
                  <tr>
                    <td width="100">Descripci&oacute;n</td>
                    <td><?php echo "".$cuento['descripcion']?></td>
                  </tr>
                </table>
            </div><br/>
            <div id="reproductor">        
            </div>
            <div id="acciones_c" class="acciones">
                <p id="btn_generarInforme"><input type="button" value="Generar Informe"/></p>
            </div>
        </div>
        <form METHOD="post" ACTION="informe.php">
            <div id="form_2" style="display:none">
            	<input type="hidden" name="id_cur" value="<?php echo $_GET['idcur'] ?>">
                <input type="hidden" name="id_cuen" value="<?php echo $_GET['idcue'] ?>">
                <div id="form_informe">
                    <div id="titulo_i"><h2>Informe de Actividad</h2></div>
                    <div id="cuerpo_i">
                        <div id="fecha_i">
                            <p>Fecha:</p>
                            <input id="fechainforme" name="fechainforme" type="text" />
                        </div>
                        <div id="contenido_i">
                            <div id="comentario1">
                                <p>Comentario 1:</p>
                                <textarea id="coment1" name="coment1" cols="50" rows="4"></textarea>
                            </div>
                            <div id="comentario2">
                                <p>Comentario 2:</p>
                                <textarea id="coment2" name="coment2" cols="50" rows="4"></textarea>
                            </div>                        
                        </div>                    
                    </div>
                </div>
                <div id="acciones_c" class="acciones">
                    <p id="btn_generar"><input type="submit" value="Generar" name="generar"></p>
                </div>            
            </div>
        </form>   	
    </div>
</body>
</html>