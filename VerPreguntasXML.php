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

<head><title> Mostrar Preguntas XML </title></head>

<body style="background-color: transparent">
        <div>	
			<?php                       
				        //Parte de XML
                        echo '<br>';                     
                        
						 //Carga del archivo a leer
                        $xml = simplexml_load_file("preguntas.xml");
                                                    
                        //Se dibuja la tabla de los usuarios
						
                        echo "Tabla de Usuarios \n";
                        echo "
                        <table border=5>
                            <tr>
                            	<th>Pregunta</th>
                                <th>Complejidad</th>												
                                <th>Tema</th>
                                <th>Respuesta</th>                                              
                            </tr>
                            
                        "; 

							
                         // Vamos imprimiendo el xml, para ello guardamos el hijo y vamos accediendo a el poco a poco
							
						foreach ($xml->assessmentItem as $pregunta)
						{		
							//Accedemos a la pregunta, luego a los atributos del hijo y finalmente a la respuesta
									 echo "<tr><td>".$pregunta->itemBody->p."</td>
									<td>".$pregunta->attributes()->complexity."</td>
									<td>".$pregunta->attributes()->subject."</td>
									<td>".$pregunta->correctResponse->value."</td></tr>";
						}                     	
                     	echo "</table>"; //para poder cerrar la tabla  
                     	 					 	                  
			?>		 
		<br>
		<a href="layout.html">Volver</a>
		
		</div>
</body>