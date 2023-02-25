<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
<body>
<?php
require('engine.php');
?>
<form action="index.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="formFile" class="form-label">Selecciona Tus Imagenes</label>
        <input class="form-control" type="file" name="fileToUpload[]" id="formFile" multiple>
    </div>
  <input  class="btn btn-primary" type="submit" value="Subir Imagenes" name="submit">
</form>
<script>
    var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
    keyboard: false
    });
    myModal.show();
</script>
</body>
</html>