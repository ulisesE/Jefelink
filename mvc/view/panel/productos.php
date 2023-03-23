<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Productos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="/index.php">Tablero</a> </li>
            <li class="breadcrumb-item active">Productos</li>
        </ol>
        <div class='mb-3'style="text-align-last: right;">
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#agregarProductoModal" onclick="$('#prodForm')[0].reset();">Nuevo Producto</button>
        </div>
        <div class="row">
            <?php
            if(isset($_GET["response"]) and $_GET["response"] == true){
                ?>
                <div class="alert alert-success">
                    Operación realizada correctamente.
                </div>
                <?php
            }
            ?>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla de productos
            </div>
            <div class="card-body table-responsive">
                <table id="" class="table">
                    <thead>
                        <tr>
                            <th>ID_Producto</th>
                            <th>Nombre</th>
                            <th>NombreCorto</th>
                            <th>Descripcion</th>
                            <th>DescripcionCorta</th>
                            <th>Precio</th>
                            <th>Edit</th>
                            <th>img</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID_Producto</th>
                            <th>Nombre</th>
                            <th>NombreCorto</th>
                            <th>Descripcion</th>
                            <th>DescripcionCorta</th>
                            <th>Precio</th>
                            <th>Edit</th>
                            <th>img</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if(count($dataToView["data"]['fetch'])>0){
                            foreach($dataToView["data"]['fetch'] as $producto){ ?>
                            <tr>
                                <td><?= $producto['ID_Producto'] ?></td>
                                <td><?= $producto['Nombre'] ?></td>
                                <td><?= $producto['NombreCorto'] ?></td>
                                <td><?= $producto['Descripcion'] ?></td>
                                <td><?= $producto['DescripcionCorta'] ?></td>
                                <td><?= $producto['Precio'] ?></td>
                                <td>
                                    <div class="form-check form-switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault<?= $producto['ID_Producto'] ?>"
                                      <?php echo $producto['status']=='A'?'checked':''; ?> data-id='<?= $producto['ID_Producto'] ?>'>
                                    </div>
                                    <button class="btn btn-primary mb-3 btnModificar" id="btnModificar" type="button" data-bs-toggle="modal" data-bs-target="#agregarProductoModal" data-id='<?= $producto['ID_Producto'] ?>'><i class="fa-solid fa-pen"></i></button>
                                    <br>
                                    <a class="btn btn-danger" type="button" href="/index.php?controller=productos&action=confirmDelete&id=<?= $producto['ID_Producto'] ?>"><i class="fa-solid fa-trash"></i></a>
                                </td>
                                <td><img id='img<?= $producto['ID_Producto'] ?>' src="/index.php?controller=productos&action=traerIMG&id=<?= $producto['ID_Producto'] ?>" style="width: 150px;height: 150px;" loading="lazy"> </td>
                            </tr>
                            <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div>
                <?php for ($paginaBtn=1; $paginaBtn <= $dataToView['data']['paginas']; $paginaBtn++) { 
                    ?> <a class="btn btn-primary active" href="/index.php?controller=productos&pagina=<?= $paginaBtn;?>"><?= $paginaBtn;?></a> <?php
                }?>
            </div>
        </div>
    </div>

    <!-- Modal -->
      <div class="modal fade" id="agregarProductoModal" data-bs-backdrop="true" data-bs-keyboard="true" tabindex="-1" aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Producto</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
              <form id="prodForm" action="/index.php?controller=productos&action=save" class="row" method="POST">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Nombre completo del producto</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="nombre">
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlInput2" class="form-label">Nombre corto del producto</label>
                  <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="" name="nombreCorto" style="width: 50%;">
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlInput3" class="form-label">Descripcion</label>
                  <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="" name="descripcion">
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlInput4" class="form-label">Palabras claves separadas por coma</label>
                  <input type="text" class="form-control" id="exampleFormControlInput4" placeholder="" name="descripcionCorta">
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlInput5" class="form-label">Precio $</label>
                  <input type="number" class="form-control" id="exampleFormControlInput5" placeholder="1.0" step="0.01" min="0" max="10000" name="precio">
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlInput6" class="form-label">Cantidad</label>
                  <input type="text" class="form-control" id="exampleFormControlInput6" placeholder="" name="cantidad">
                </div>
                <div class="mb-3 col-6">
                  <label for="formFile" class="form-label">Imagen para mostrar en catalogo</label>
                  <input class="form-control" type="file" id="fileToUpload" accept="image/png, image/jpeg" name="fileToUpload">

                  <input class="form-control" type="text" id="exampleFormControlInput7" name="img" hidden>
                  <input class="form-control" type="text" id="exampleFormControlInput8" name="id" hidden>
                </div>
                <div class="mb-3 col-6" id="root1">
                    <canvas id="canvas"></canvas>
                </div>
                <button type="submit" class="btn btn-outline-success">Guardar</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

</main>
<script type="text/javascript">
    window.addEventListener("load", (event) => {
        $('.form-check-input').change(function(){
            $.ajax({
                method: "POST",
                url: "/index.php?controller=productos&action=cambiarEstatus",
                data: {
                    idProd: $(this).data("id"),
                    estatus: $(this).prop("checked")
                },
                success: function(responseText) {
                }
            });
        });

        //-----------------
        //img preview
        var view = {};
        var imgBase64 = '';

        const MAX_WIDTH = 250;
        const MAX_HEIGHT = 250;
        const MIME_TYPE = "image/jpeg";
        const QUALITY = 0.7;

        const input = document.getElementById('fileToUpload');
        input.onchange = function (ev) {
          const file = ev.target.files[0]; // get the file
          const blobURL = URL.createObjectURL(file);
          const img = new Image();
          img.src = blobURL;
          img.onerror = function () {
            URL.revokeObjectURL(this.src);
            // Handle the failure properly
            console.log("Cannot load image");
          };
          img.onload = function () {
            URL.revokeObjectURL(this.src);
            const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
            const canvas = document.createElement("canvas");
            canvas.width = newWidth;
            canvas.id = "canvas";
            canvas.height = newHeight;
            const ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, newWidth, newHeight);
            canvas.toBlob(
            blob => {
              // Handle the compressed image. es. upload or save in local state
              /*displayInfo('Original file', file, 1);
              displayInfo('Compressed file', blob, 1);*/
            },
            MIME_TYPE,
            QUALITY);
            $('#root1').html(canvas);
            var target = new Image();
            target.src = canvas.toDataURL();
            imgBase64 = $(target).attr('src').replace("data:image/png;base64,",'').replace("'",'');
            $('#exampleFormControlInput7').val(imgBase64);
          };
        };
        function calculateSize(img, maxWidth, maxHeight) {
          let width = img.width;
          let height = img.height;

          // calculate the width and height, constraining the proportions
          if (width > height) {
            if (width > maxWidth) {
              height = Math.round(height * maxWidth / width);
              width = maxWidth;
            }
          } else {
            if (height > maxHeight) {
              width = Math.round(width * maxHeight / height);
              height = maxHeight;
            }
          }
          return [width, height];
        }

        // Utility functions for demo purpose

        function displayInfo(label, file, root) {
          const p = document.createElement('p');
          p.innerText = `${label} - ${readableBytes(file.size)}`;
          document.getElementById('root'+root).append(p);
        }

        function readableBytes(bytes) {
          const i = Math.floor(Math.log(bytes) / Math.log(1024)),
          sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

          return (bytes / Math.pow(1024, i)).toFixed(2) + ' ' + sizes[i];
        }

        function obtenerImg64(id){
            var imagen = document.getElementById("img"+id);
            var canvas = document.getElementById("canvas");

            // Dibujar la imagen en el canvas
            canvas.width = imagen.width;
            canvas.height = imagen.height;
            var contexto = canvas.getContext("2d");
            contexto.drawImage(imagen, 0, 0);

            // Obtener la cadena Base64 del canvas
            return base64 = canvas.toDataURL().replace("data:image/png;base64,",'').replace("'",'');
        }

        $(".btnModificar").click(function(){
            $td = $($(this).closest("tr")).children();

            $('#exampleFormControlInput1').val($td[1].textContent);
            $('#exampleFormControlInput2').val($td[2].textContent);
            $('#exampleFormControlInput3').val($td[3].textContent);
            $('#exampleFormControlInput4').val($td[4].textContent);
            $('#exampleFormControlInput5').val($td[5].textContent);
            $('#exampleFormControlInput6').val(1);
            $('#exampleFormControlInput7').val('0');
            obtenerImg64($td[0].textContent);
            $('#exampleFormControlInput8').val($td[0].textContent);

        });
    });
</script>