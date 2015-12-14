<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 	
<!--Para que podamos usar acentos y caracteres raros -->
<head><title> Registrar </title></head>

<body>
        <div>	
			<?php 
			
			//Generación de variables para conexión a Base de Datos
			$server = "mysql.hostinger.es";
			$user = "u347232914_root"; 		
			$password = "root123"; 	
			$bd_name = "u347232914_quiz";
			
			
			//añadida la parte de seguridad, con filter_var podemos validar el correo electronico
			//Vamos a validar el resto de variables también, para ello usamos preg_match y la expresión regular que usamos en el apartado de registro en el jscript
			//strlen sirve para medir el numero de caracteres de una variable
			
			if ((!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) === false) and 
				(preg_match("/^[a-zA-Z]+\d{3}@ikasle\.ehu\.(es|eus)$/", $_POST['mail'])) and
				(strlen($_POST['pass']) >= 6) and (preg_match("/^\d{9}$/", $_POST['numero'])) and
				(strlen($_POST['especialidad']) >= 5) and 
				(preg_match("/^[a-zA-Z]+[a-zA-Z] [a-zA-Z]+[a-zA-Z] [a-zA-Z]+[a-zA-Z]( [a-zA-Z]+[a-zA-Z])*$/",		
				$_POST['nombreCompleto'])))
			
			{
			
			//Conexión de Base de Datos	 
			$connection = new mysqli($server, $user, $password, $bd_name);
		 
			// Check connection
			if ($connection->connect_error) {
			    die("Connection failed: " . $connection->connect_error);
			} 	 
			
			//generamos la sentencia sql para insertar los datos
			$sql = "INSERT INTO usuario (nombre, email, password, telefono, especialidad, fotografia)	
			VALUES ('{$_POST['nombreCompleto']}','{$_POST['mail']}','{$_POST['pass']}','{$_POST['numero']}','{$_POST['especialidad']}', null)";
		 
				//Si se crea correctamente la consulta, el query de sql devolverá true
				if ($connection->query($sql) === TRUE) {
				echo "Se ha agregado correctamente el registro a la base de datos.";
				} 
				else {
				echo "Error: " . $sql . "<br>" . $connection->error;
				}	
			$connection->close();
			
			}
			
			else 
			{
				echo "Error en la validación de uno de los formularios";
				
			}
		 ?>
		 
		<br>
		<a href="layout.html">Volver</a>
		
		</div>
</body>