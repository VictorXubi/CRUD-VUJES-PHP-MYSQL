<?php 

header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: *");

require_once 'DepartamentoPDO.php';

$accion = "mostrar";
$res = array();

if(isset($_GET['accion'])){
	$accion = $_GET['accion'];
}

	switch ($accion) {
	case 'mostrar':	
		$u = DepartamentoPDO::mostrarDepartamento();
		if($u){
			$res['departamentos'] = $u;			
		}else{
			$res['mensaje'] = "Aun no hay registros";			
		}
		break;
		
	case 'buscar':		
		$descripcion = $_POST['busqueda'];
		
		$u = DepartamentoPDO::buscarDepartamentoPorDescripcion($descripcion);
		
		if($u){
			$res['departamentos'] = $u;	
			$res['mensaje'] = "Exito";			
		}else{
			$res['mensaje'] = "Error";			
		}
		
		break;	
		
	case 'insertar':		
		$codigo = $_POST['CodDepartamento'];
		$descripcion = $_POST['DescDepartamento'];
		$volumen = $_POST['VolumenNegocio'];
		
		$codigoRepetido = DepartamentoPDO::validarCodNoExiste($codigo);
		
		if($codigoRepetido){
			$res['error'] = "El codigo ya esta en la Base De Datos";
		}else{
			$u = DepartamentoPDO::altaDepartamento($codigo,$descripcion,$volumen);
		
			if($u){
				$res['mensaje'] = "Exito";			
			}else{
				$res['mensaje'] = "Error";			
			}
		}
		break;
		
	case 'editar':		
		$codigo = $_POST['eCodDepartamento'];
		$descripcion = $_POST['eDescDepartamento'];
		$volumen = $_POST['eVolumenNegocio'];
		
		$u = DepartamentoPDO::modificaDepartamento($codigo,$descripcion,$volumen);
		
		if($u){
			$res['mensaje'] = "Exito";			
		}else{
			$res['mensaje'] = "Error";			
		}
		
		break;
		
	case 'eliminar':		
		$codigo = $_POST['bCodDepartamento'];
		
		$u = DepartamentoPDO::eliminarDepartamento($codigo);
		
		if($u){
			$res['mensaje'] = "Exito";			
		}else{
			$res['mensaje'] = "Error";			
		}
		
		break;
	}

echo json_encode($res);
die();

?>