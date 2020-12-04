<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ajax y Php</title>
    <script>
        function mostrarDescripcion( valor){
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function(){
                if(xmlHttp.readyState == 4 && xmlHttp.status == 200){
                    document.getElementById("txtAjax").innerHTML =  xmlHttp.responseText;            
                }
            }
            xmlHttp.open("GET","backend.php?id="+ valor,true);
            xmlHttp.send();
        }
    </script>
</head>
<body>
    <h2>Mis Clientes</h2>
    <select name="clientes" onchange="mostrarDescripcion(this.value)">
    <?php
        $con = @mysqli_connect("localhost","jaime","jaime1234","pruebaajax");
        if(!$con){
            echo "<p> Error al conectar con la BD ". mysql_connect_error() ."</p>";
            exit;
        }
        $sentencia = "select * from clientes";
        if(!($resultado = mysqli_query($con, $sentencia))){
            echo "<p> Error al ejecutar consulta </p>";
        }
        //fetch Obtener una fila de resultado como un array asociativo
        while ($fila = mysqli_fetch_assoc($resultado)) { 
            echo "<option value='{$fila['Id']}'>{$fila['Nombre']}</option>";
        }
        mysqli_free_result($resultado);
		mysqli_close($con);

    ?>
    </select>
    <div id="txtAjax">
    La informaciòn del cliente se mostrarà aquì.
    </div>
</body>
</html>