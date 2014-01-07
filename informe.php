<?php
	/**************************************************************************************/
	/*Autores:                                                                            */
	/*         Pamela Morales Moena                                                       */
	/*         Jose Luis Ramirez Barra                                                    */
	/*                                                                                    */
	/*Año    : 2013                                                                       */
	/**************************************************************************************/
	include 'coneccion.php';
	require_once('fpdf/fpdf.php');
	
	class PDF extends FPDF
	{
		function Footer() // Pie de página
		{
			$this->SetFont('Arial','B',8);
			// Posición: a 1,5 cm del final
			$this->SetY(-15);
			$this->Cell(0,10,'Proyecto STEM UACH 2013 - Pamela Morales, Jose Luis Ramirez - Ingeniería Civil en Informática','T',0,'C');
		}
		function Header() //Encabezado
		{
			//Define tipo de letra a usar, Arial, Negrita, 15
			$this->SetFont('Arial','B',14);
			//Líneas paralelas
			$this->Line(10,10,206,10);
			$this->Line(10,35.5,206,35.5);
	 		//cell donde se encuentran los elementos
			$this->Cell(30,25,'',0,0,'C');
			$this->Cell(111,25,'Proyecto STEM UACH',0,0,'C', $this->Image('images/logo_uach.png',20,12,19));
			$this->Cell(40,25,'',0,0,'C',$this->Image('images/Logo_ICI_UACh.jpg', 152, 12, 35));	 
			//Se da un salto de línea de 25
			$this->Ln(25);
		}
		function TituloCuento($id_cuento)
		{
			$cuento = mysql_fetch_array(mysql_query("SELECT * FROM cuentos WHERE id='".$id_cuento."'"));
			$nombre = $cuento['nombre'];
			$this->SetFont('Arial','B',11);
			$this->Cell(0,5,$nombre,0,1,'C');
		}
		function Asistentes($id_curso)
		{
			$alumnos = mysql_query("SELECT * FROM alumno WHERE curso='".$id_curso."'AND asistencia=1");
			$this->Cell(50,5,'Nombre',1,0,'C');
			$this->Cell(50,5,'Apellido Paterno',1,0,'C');
			$this->Cell(50,5,'Apellido Materno',1,1,'C');
			while ($alumno=mysql_fetch_array($alumnos)){
				$this->Cell(50,5,$alumno['nombre'],1,0,'C');
				$this->Cell(50,5,$alumno['apellido1'],1,0,'C');
				$this->Cell(50,5,$alumno['apellido2'],1,1,'C');
			}
		}
		function ImprimirPrologo($id_cuento)
		{
			$query = mysql_fetch_array(mysql_query("SELECT * FROM cuentos WHERE id='".$id_cuento."'"));
			// Leemos el archivo de texto
			$prologo = $query['resumen'];
			$this->SetFont('Arial','',10);
			$this->MultiCell(0,5,$prologo);	 
		}
		function ImprimirComentario($comentario)
		{
			$this->SetFont('Arial','',10);
			$this->MultiCell(0,5,$comentario);	
		}
	}
	//Crea objeto PDF
	$pdf = new PDF();
	//Vertical, Carta
	$pdf->AddPage('P', 'Letter');
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(0,10,$_POST['fechainforme'],0,1,'R');
	$pdf->TituloCuento($_POST['id_cur']);
	$pdf->Ln();
	$pdf->Cell(0,5,'Lista de Alumnos',0,1,'L');
	$pdf->Ln();
	$pdf->Asistentes($_POST['id_cur']);
	$pdf->Ln();
	$pdf->Cell(0,5,'Prologo',0,1,'L');
	$pdf->Ln();
	$pdf->ImprimirPrologo($_POST['id_cuen']);
	$pdf->Ln();
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(0,5,'Primer Comentario',0,1,'L');
	$pdf->ImprimirComentario($_POST['coment1']);
	$pdf->Ln();
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(0,5,'Segundo Comentario',0,1,'L');
	$pdf->ImprimirComentario($_POST['coment2']);
	$pdf->Output();//Salida al navegador
?>