<?php
$target_dir = "img/";
$uploadOk = 1;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $fileNames = array_filter($_FILES['fileToUpload']['tmp_name']);
    $tableHTML= '
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nombre</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
      ';
  if(!empty($fileNames)){ 
    foreach($_FILES['fileToUpload']['name'] as $key=>$val){ 
      $tableHTML= $tableHTML ."
      <tr>
      <td> $key </td>
      <td> ".htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$key]))."</td>
      <td>
      ";
      $target_file = $target_dir . basename($_FILES['fileToUpload']['name'][$key]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$key]);
      if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        $tableHTML= $tableHTML ."el archivo no es una imagen.<br>";
        $uploadOk = 0;
      }
      
      // Check if file already exists
      if (file_exists($target_file)) {
        $tableHTML= $tableHTML ."el archivo ya existe.<br>";
        $uploadOk = 0;
      }

      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        $tableHTML= $tableHTML ."solo archivos tipo imagen JPG, JPEG, PNG & GIF son permitidos.<br>";
        $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        //echo "el archivo no se subió.<br>";
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
          $tableHTML= $tableHTML ."El archivo ha sido subido correctamente.<hr>";
        } else {
          $tableHTML= $tableHTML ."tubimos un error al subir el archivo.<hr>";
        }
      }
      $tableHTML= $tableHTML ."</td></tr>";
    }
  }


    
$tableHTML= $tableHTML .'
    </tbody>
  </table>
';
?>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Reporte Imagenes</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?php echo $tableHTML; ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php } ?>