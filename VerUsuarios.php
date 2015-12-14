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

<head><title> Mostrar Usuarios </title></head>

<body style="background-color: transparent">
        <div>	
			<?php 
			
			//Generación de variables para conexión a Base de Datos
			$server = "mysql.hostinger.es";
			$user = "u347232914_root"; 		
			$password = "root123"; 	
			$bd_name = "u347232914_quiz";
			
			
			//Conexión de Base de Datos	 
			$connection = new mysqli($server, $user, $password, $bd_name);
		 
			// Check connection
			if ($connection->connect_error) {
			    die("Connection failed: " . $connection->connect_error);
			} 	 
			
			$sql = "SELECT * FROM usuario";		       
            $consulta = mysqli_query($connection, $sql);
            $num_filas= $consulta->num_rows;
                        
                        
                        //Se dibuja la tabla de los usuarios
                    if ($num_filas > 0) {
                       
                        echo "Tabla de Usuarios \n";
                        echo "
                        <table border=5>
                            <tr>
                                <th>Nombre Completo</th>												
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Especialidad</th>                       
                            </tr>
                            
                        "; 
                        
                        // fetch_assoc(): Devuelve un array asociativo de strings que representa a la fila obtenida del conjunto de resultados, 
                        // donde cada clave del array representa el nombre de una de las columnas de éste
                        
                        while($row = $consulta->fetch_assoc()) {
                            echo "
                            <tr> 
                                <td>".$row["nombre"]."</td>
                                <td>".$row["email"]."</td>
                                <td>".$row["telefono"]."</td>
                                <td>".$row["especialidad"]."</td>                                  
                            </tr>";
                        }
                        //variables .$X. para imprimir?
                        
                        echo "</table>"; //para poder cerrar la tabla
                    } else {
                        echo "No hay entradas en la DB.";
                    }
              $connection->close();
  
			?>		 
		<br>
		<a href="layout.html">Volver</a>
		
		</div>
</body>