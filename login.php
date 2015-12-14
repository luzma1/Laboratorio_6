<?php			
			// Si sabemos que no necesitamos cambiar nada de la sesión,
			// podemos simplemente leerla y cerrarla inmediatamente para evitar
			// bloquear el fichero de sesión y otras páginas
						
			session_start();
			
			//Generación de variables para conexión a Base de Datos
			$server = "mysql.hostinger.es";
			$user = "u347232914_root"; 		
			$password = "root123"; 	
			$bd_name = "u347232914_quiz";
			
			//$server = "localhost";
			//$user = "root"; 		
			//$password = "root"; 	
			//$bd_name = "Quiz";
			
			
					
			//Conexión de Base de Datos	 
			$connection = new mysqli($server, $user, $password, $bd_name);
		 
			// Check connection
			if ($connection->connect_error) {
			    die("Connection failed: " . $connection->connect_error);
			} 	 
			
			//generamos la sentencia sql para insertar los datos
			$sql = "SELECT password FROM usuario WHERE email = '" . $_POST['email'] . "' and password = '" . $_POST['password'] . "'";	
			//el query en el caso de encontrar una consulta nos devuelve una estructura
			$result=$connection->query($sql);
			
			//Parte optativa 1, metemos el correo, la id y la hora:
			$sqlID = "INSERT INTO conexiones (mail)
			VALUES ('{$_POST['email']}')";
									
			//cerramos la conexion
			$connection->close();
			
			
			if ($result->num_rows > 0)
				{	
				$_SESSION["email"] = $_POST['email'];
				header("Location:InsertarPregunta.html");
				exit;
				} 
				else {
				echo "Error: Login incorrecto";
				echo '<br>';
				echo '<a href="layout.html">Volver</a>';				
				}	
?>