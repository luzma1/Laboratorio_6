<?php
	switch($_GET['f']) {
		case "insertarPregunta":
			echo insertarPregunta($_GET['email'], $_GET['pregunta'], $_GET['respuesta'],$_GET['complejidad']);
			break;
		case "modificarPregunta":
			echo modificarPregunta($_GET['id'], $_GET['pregunta'], $_GET['respuesta'],$_GET['complejidad']);
			break;
			// http: //swluzma.esy.es/Laboratorio_6/preguntas.php?f=modificarPregunta&id=29&pregunta=nuevovalor&respuesta=modificad1o&complejidad=5
			// http: //localhost:8888/sistemas_web/Laboratorio_6/preguntas.php?f=modificarPregunta&id=30&pregunta=nuevovalor&respuesta=modificado&complejidad=5

	} 
	
	function insertarPregunta($email, $pregunta, $respuesta, $complejidad)
	{	
		echo "estoy";
				//Generación de variables para conexión a Base de Datos
			$server = "mysql.hostinger.es";
			$user = "u347232914_root"; 		
			$password = "root123"; 	
			$bd_name = "u347232914_quiz";
			
			//$server = "localhost";
			//$user = "root"; 		
			//$password = "root"; 	
			//$bd_name = "Quiz";
			
			
			session_start(); //Creamos una session
			
			//Funcion para coger la ip del cliente
			// http://stackoverflow.com/questions/15699101/get-the-client-ip-address-using-php
			
			function get_client_ip() {
				$ipaddress = '';
				if (getenv('HTTP_CLIENT_IP'))
					$ipaddress = getenv('HTTP_CLIENT_IP');
				else if(getenv('HTTP_X_FORWARDED_FOR'))
					$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
				else if(getenv('HTTP_X_FORWARDED'))
					$ipaddress = getenv('HTTP_X_FORWARDED');
				else if(getenv('HTTP_FORWARDED_FOR'))
					$ipaddress = getenv('HTTP_FORWARDED_FOR');
				else if(getenv('HTTP_FORWARDED'))
				   $ipaddress = getenv('HTTP_FORWARDED');
				else if(getenv('REMOTE_ADDR'))
					$ipaddress = getenv('REMOTE_ADDR');
				else
					$ipaddress = 'UNKNOWN';
				return $ipaddress;
			}
				
			$dir_ip=get_client_ip();
			

	//Validacion del formulario
		if ((strlen($pregunta) >= 6) and (strlen($respuesta) >= 2) and (strlen($complejidad) >= 1) and (strlen($complejidad) <= 5)) 
		{			
			$connection = new mysqli($server, $user, $password, $bd_name);
			// Comprobar la conexion
			if ($connection->connect_error) {
				die("Connection failed: " . $connection->connect_error);
			}
			else
			{
				//Inserción de las preguntas				
				$sql = "INSERT INTO preguntas (pregunta, respuesta, complejidad, email)
				VALUES ('{$pregunta}','{$respuesta}','{$complejidad}','{$email}')";


				if ($connection->query($sql) === FALSE) 
				{
					echo "Error: " . $sql . "<br>" . $connection->error;
				}

				//Insertamos los datos del usuario que ha insertado la pregunta
				
				$acciones = "INSERT INTO acciones (idconnection, mail, tipo, ip)
				VALUES (NULL ,'{$email}', '1','{$dir_ip}')";
				
				if ($connection->query($acciones) === FALSE) {
					
					echo "Error: " . $acciones . "<br>" . $connection->error;
				}
				$connection->close();
				
				// Inserción de xml
				// Cargamos el fichero
				$xml = simplexml_load_file("preguntas.xml");
				
				//añadimos un hijo al XML, el assessmentItem
				$preguntaXML = $xml->addChild('assessmentItem');
				//Introducimos sus atributos
				$preguntaXML->addAttribute('complexity',$complejidad); 
				$preguntaXML->addAttribute('subject', $tema); 
				
				//añadimos otro hijo, itemBody
				$itemBody = $preguntaXML->addChild('itemBody');
				//Introducimos sus atributos
				$itemBody->addChild('p', $pregunta);
				
				//añadimos otro hijo de preguntaXML itemBody
				$correctResponse = $preguntaXML->addChild('correctResponse'); 
				$correctResponse->addChild('value', $respuesta);
			
				// Guardamos el XML
				$xml->asXML('preguntas.xml');
				return true;				
			}
		}
		
		else
		{
			return false;
		}
			
			
	}
	
	
	function modificarPregunta($id, $pregunta, $respuesta, $complejidad) 
	{
		
			//Generación de variables para conexión a Base de Datos
			$server = "mysql.hostinger.es";
			$user = "u347232914_root"; 		
			$password = "root123"; 	
			$bd_name = "u347232914_quiz";
			
			//$server = "localhost";
			//$user = "root"; 		
			//$password = "root"; 	
			//$bd_name = "Quiz";
				
			session_start(); //Creamos una session
					
	
//		Validacion del formulario
		if ((strlen($pregunta) >= 6) and (strlen($respuesta) >= 2) and (strlen($complejidad) >= 1) and (strlen($complejidad) <= 5)) 
		{			
			$connection = new mysqli($server, $user, $password, $bd_name);
			// Comprobar la conexion
			if ($connection->connect_error) {
				die("Connection failed: " . $connection->connect_error);
			}
			else
			{	
				
				//Inserción de las preguntas				
				$sql = "UPDATE preguntas SET pregunta = '{$pregunta}', respuesta = '{$respuesta}', complejidad = '{$complejidad}' WHERE id='{$id}'";

				if ($connection->query($sql) === FALSE) 
				{
					echo "Error: " . $sql . "<br>" . $connection->error;
				}					
				return true;
			}
	
		}
		else return false;

	}	
?>