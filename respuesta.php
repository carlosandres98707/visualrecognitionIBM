<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <title>Tabla de datos</title>
    <style type="text/css">
    #tabla{
        width: 600px;
        text-align: center;
        position: relative;
        margin-top: 20px;
        transform: translateX(800px);
    }
    img{
        position: absolute;
        margin-top: 20px;
        transform: translateX(200px);
    }
    </style>
</head>
<body>

<?php

/*
Para conectarnos al servicio de ibm necesitaremos tres cosas:
// Endpoint donde se conecta el servicio
// El usuario y la contraseña en este caso la apikey
// La url de la imagen que le pasaremos como parametro
 */


// Enpoint 
$apiEndpoint="https://gateway.watsonplatform.net/visual-recognition/api/v3/classify?version=2018-03-19";
//Rrecibimos la url de la imagen enviada por el formulario
$imagen = $_POST['imagen'];
// $apikey = "SyeLbnqWj9DyDxpGj-RUSd75YmzXI8sIAk1VumboEuKe"
// Aca recibimos la apikey enviada desde el formulario
$apikey= $_POST['apikey'];

//En esta parte unificamos la url de la imagen con el parametro que necesita llevar
//  para ser llamada desde el endpoint
$data = "url=".$imagen;

//Iniciamos nuestro curl y le pasamos los parametros
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
    curl_setopt($ch, CURLOPT_USERPWD, 'apikey:'.$apikey);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);

    //Si ocurre algun error en el proceso lo mostramos aqui
    if(curl_exec($ch) === false)
    {
        echo 'Curl error: ' . curl_error($ch);
    }
        curl_close($ch);
    
    // Los datos los recibimos como formato JSON para poder leerlos
    $datos = json_decode($result,TRUE);
    $tamaño = sizeof($datos);
    
    // Capturamos y mostramos los diferentes errores que nos podria arrojar el JSON
    if($tamaño == 2){
        $errorImagen = $datos["images"][0]["error"]["code"];
        $descripcion = $datos["images"][0]["error"]["description"];
        print_r("<h1>Codigo Error: ".$errorImagen."<br> Descripcion: ".$descripcion." (La url de la imagen esta mal colocada o el enlaze esta roto)</h1>");
        print_r("<h1>Recuerda que la url debe tener un formato valido para  analizar la imagen ya sea png jpeg o jpg</h1>");
    }else{
        if(empty($datos["images"])){
          $codigoError =  $datos["code"];
          $descripcion = $datos["error"];
         print_r("<h1>Codigo Error: ".$codigoError."<br> Descripcion: ".$descripcion." (La apikey del servicio esta mal colocada o no tiene acceso al servicio)</h1>");
        }else{
            // Si no hay errores en el proceso mostramos los datos que nos devolvio el servicio
             $tamjson = sizeof($datos["images"][0]["classifiers"][0]["classes"]);
   ?>

   <div>
        <img src="<?php echo $imagen;?>" alt="" srcset="" width="500px" height="500px">
    </div>
   <table class="table" border="1" id="tabla">
   <thead class="thead-dark">
   
   <tr >
   <th >Clase</th>
   <th>Score</th>
   <th>Porcentaje</th>
   </tr>
   </thead>
  <?php  for($i=0;$i<$tamjson;$i++){
   $porcentaje =$datos["images"][0]["classifiers"][0]["classes"][$i]["score"]*100;
?>
<tr>
<td><?php print_r($datos["images"][0]["classifiers"][0]["classes"][$i]["class"]);?></td>
<td><?php print_r($datos["images"][0]["classifiers"][0]["classes"][$i]["score"]);?></td>
<td><?php print_r($porcentaje."%");?></td>


</tr>
<?php }
        }
    }
?>
</table>
</body>
</html>




