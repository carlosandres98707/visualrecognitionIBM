<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&family=Balsamiq+Sans&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script >
        alert("Advertencia: al Ingresar la url de la imagen intenta que esta termine en un formato admitido o el servicio podria presentar fallas. Por favor intenta que la misma termine en formatos tales como png jpg o jpeg.");
    </script>
    <title>Visual Recognition</title>
</head>
<body>
<header></header>
<main>
<h1>Reconocimiento de Imagenes</h1><br>
<form action="respuesta.php" method="post">
    <label for="caja">Ingresa la url de la imagen:</label><br>
    <input type="url" name="imagen" class="caja" id="caja1" placeholder="https://fruktal.com/banano-600x600.jpg" required><br><br>
    <label for="caja2">Ingresa la Api Key del servicio:</label><br>
    <input type="text" name="apikey" class="caja" id="caja1" required><br><br>
    <button type="submit" class="btn btn-success" id="boton">Enviar</button>
    </form>
</main>
<footer></footer>

</body>
</html>