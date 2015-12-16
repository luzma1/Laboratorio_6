<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 	
<!--Para que podamos usar acentos y caracteres raros -->
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />

<head><title> Insertar Pregunta </title>
	
<script>
<?php
	//MIRAR LO DEL EMAIL
	session_start(); //Creamos una session
	
	//Comprobamos si en nuestra sesion estamos logeados o no
	$email = $_SESSION["email"];
?>
				
		var xmlhttp = new XMLHttpRequest();

		function insertarPregunta() {		
				
				
				var form = document.getElementById("registro");
				var pregunta = form.pregunta.value;
				var respuesta = form.respuesta.value;
				var complejidad = form.complejidad.value;
				var email= "<?php echo $email; ?>";	
				//var mail= "lhorvath001@ikasle.ehu.eus";	

								
				// Así se añaden las preguntas 
				
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState==4 && xmlhttp.status==200){
						if (xmlhttp.responseText != "false") {
							alert("Todo esta correcto");
							document.getElementById("registro").pregunta.value = "";
							document.getElementById("registro").respuesta.value = "";
							document.getElementById("registro").complejidad.value = 1;
							//CREAR UN DIV CON ID MENSAJE Y LO MODIFICO DICIENDO QUE TODO VA BIEN
							//MIRAR LO DEL MAIL
													
						} else { 
							alert("Su pregunta no ha podido ser procesada. Compruebe que ha rellenado los campos correctamente.");
						}
					}
				}
				//Con Get es mas sencillo 										
				//xmlhttp.open("GET","preguntas.php?f=insertarPregunta", true);
				
				xmlhttp.open("GET","preguntas.php?f=insertarPregunta&email=" + email + "&pregunta=" + pregunta + "&respuesta=" + respuesta + "&complejidad=" + complejidad, true);

				
				//http: //swluzma.esy.es/Laboratorio_6/preguntas.php?funcion=insertarPregunta&email=asdfasdf&pregunta=asuuhuhudf&respuesta=asdrf&complejidad=3
				xmlhttp.send();
			}
		
		
	
</script>	

</head>

<body style="background-color: transparent"> 
 
    <h2>Gestionar Preguntas</h2>
    <br>
    <h3>Inserte una pregunta y una respuesta.</h3>
		
		<form name='registro' id='registro'> 
		
			Pregunta<br/>
			<input type="text" id="pregunta" name="pregunta">
			<br/><br/>
		    
		    Respuesta<br/>
				<input type="text" id="respuesta" name="respuesta">
			<br/><br/>
			
			Complejidad<br/>
		    <input type="range" id="complejidad" name="complejidad" min="1" max="5" value="1" oninput="document.getElementById('valor').textContent=value">
		    <output id="valor">1</output>
		    <br/><br/>
		    
		    <input type="button" value="enviar ajax" name="insertarPreguntaButton" onclick = "insertarPregunta()"></input>

		</form>
		
		<br>
		
<?php		//Generación de variables para conexión a Base de Datos
			$server = "mysql.hostinger.es";
			$user = "u347232914_root"; 		
			$password = "root123"; 	
			$bd_name = "u347232914_quiz";
			
			//MIRAR LO DEL EMAIL
			session_start(); //Creamos una session
			
			//Comprobamos si en nuestra sesion estamos logeados o no
			$email = $_SESSION["email"];
						
			//Conexión de Base de Datos	 
			$connection = new mysqli($server, $user, $password, $bd_name);
		 
			// Check connection
			if ($connection->connect_error) {
			    die("Connection failed: " . $connection->connect_error);
			} 	 
			
			$sql = "SELECT * FROM preguntas WHERE preguntas.email='{$email}'";		       
            $consulta = mysqli_query($connection, $sql);
            $num_filas= $consulta->num_rows;
                        
                        
                        //Se dibuja la tabla de los usuarios
                    if ($num_filas > 0) {
                       
                        echo "Tabla de Preguntas personales \n";
                        echo '<br>';
                        echo "
                        <table border=5>
                            <tr>
                                <th>Preguntas</th>
                                <th>Respuestas</th>										
                                <th>Complejidad</th>                                              
                            </tr>
                            
                        "; 
                        
                        // fetch_assoc(): Devuelve un array asociativo de strings que representa a la fila obtenida del conjunto de resultados, 
                        // donde cada clave del array representa el nombre de una de las columnas de éste
                        
                        while($row = $consulta->fetch_assoc()) {
                            echo "
                            <tr> 
                                <td>".$row["pregunta"]."</td>
                                <td>".$row["respuesta"]."</td>
                                <td>".$row["complejidad"]."</td>
                                <td><input id='".$row["id"]."_button' type='button' id='".$row["id"]."_button' value='Editar' onClick='seleccionarPregunta(".$row['id'].")'/></td>                                
                            </tr>";
                        }
                        //variables .$X. para imprimir?
                        
                        echo "</table>"; //para poder cerrar la tabla
                    } else {
                        echo "No hay entradas en la DB.";
                    }
                    
?>		
	
</body> 

</html>