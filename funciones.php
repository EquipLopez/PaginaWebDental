<?php
	function conexion(){
		try{
			//se realiza la conexion de la base de datos.
			$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
			return $conexion;
		}catch(PDOException $e){
			return false;
		}
	}
	function limpiarDatos($datos){
		$datos = trim($datos);
		$datos = stripslashes($datos);
		$datos = htmlspecialchars($datos);
		return $datos;
	}
	function id_numeros($id){
		return (int)limpiarDatos($id);
	}

	function obtener_dentista_id($conexion,$id){
		//se realiza la consulta para obtener todos los datos de la tabla dentistas mediante el id.
		$resultado = $conexion->query("SELECT * FROM dentistas WHERE idDentista = $id LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}
	function obtener_paciente_id($conexion,$id){
		//se realiza la consulta para obtener todos los datos de la tabla pacientes mediante el id.
        $resultado = $conexion->query("SELECT * FROM pacientes WHERE idPaciente = $id LIMIT 1");
		$resultado = $resultado->fetchall();
		return ($resultado) ? $resultado : false;
    }
    function obtenerUser_id($conexion,$id){
    	//se realiza la consulta para obtener todos los datos de la tabla usuarios mediante el id.
        $resultado = $conexion->query("SELECT * FROM usuarios WHERE id = $id LIMIT 1");
		$resultado = $resultado->fetchall();
		return ($resultado) ? $resultado : false;
        
    }
    function obtener_consultorio_id($conexion,$id_consultorio){
    	//se realiza la consulta para obtener todos los datos de la tabla consultorios mediante el id.
        $resultado = $conexion->query("SELECT * FROM consultorios WHERE idConsultorio = $id_consultorio LIMIT 1");
		$resultado = $resultado->fetchall();
		return ($resultado) ? $resultado : false;
    }
    function obtener_especialidad_id($conexion,$id_especialidad){
    	//se realiza la consulta para obtener todos los datos de la tabla especialidades mediante el id.
        $resultado = $conexion->query("SELECT * FROM especialidades WHERE idespecialidad = $id_especialidad LIMIT 1");
		$resultado = $resultado->fetchall();
		return ($resultado) ? $resultado : false;
    }
    function obtener_cita_id($conexion,$id_cita){
    	//se realiza la consulta para obtener todos los datos de la tabla citas mediante el id.
        $resultado = $conexion->query("SELECT * FROM citas WHERE idcita = $id_cita LIMIT 1");
		$resultado = $resultado->fetchall();
		return ($resultado) ? $resultado : false;
    }

?>