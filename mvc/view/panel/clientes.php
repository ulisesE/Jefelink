<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Clientes</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="/index.php">Tablero</a> </li>
            <li class="breadcrumb-item active">Clientes</li>
        </ol>
        <div class='mb-3'style="text-align-last: right;">
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#agregarProductoModal" onclick="$('#cliForm')[0].reset();">Nuevo Cliente</button>
        </div>
        <div class="row">
            <?php
            if (isset($_GET["response"])) {
                if($_GET["response"] =='-23000'){
                    ?>
                    <div class="alert alert-warning">
                        Ese correo ya esta registrado intento con otro.
                    </div>
                    <?php
                }else if($_GET["response"] == true){
                    ?>
                    <div class="alert alert-success">
                        Operación realizada correctamente.
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla de clientes
            </div>
            <div class="card-body table-responsive">
                <table id="" class="table">
                    <thead>
                        <tr>
                            <th>ID_Cliente</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Usuario</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID_Cliente</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Usuario</th>
                            <th>Editar</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if(count($dataToView["data"]['fetch'])>0){
                            foreach($dataToView["data"]['fetch'] as $cliente){ ?>
                            <tr>
                                <td><?= $cliente['ID_Cliente']?></td>
                                <td><?= $cliente['Nombre'] ?></td>
                                <td><?= $cliente['Apellido'] ?></td>
                                <td><?= $cliente['Direccion'] ?></td>
                                <td><?= $cliente['Telefono'] ?></td>
                                <td><?= $cliente['email'] ?></td>
                                <td><?= $cliente['usuario'] ?></td>
                                <td>
                                    <button class="btn btn-primary mb-3 btnModificar" id="btnModificar" type="button" data-bs-toggle="modal" data-bs-target="#agregarProductoModal" 
                                    data-email='<?= $cliente['email'] ?>' 
                                    data-user='<?= $cliente['usuario'] ?>' 
                                    data-pass='<?= $cliente['contra'] ?>'><i class="fa-solid fa-pen"></i></button>
                                    <br>
                                    <a class="btn btn-danger" type="button" href="/index.php?controller=clientes&action=confirmDelete&id=<?= $cliente['ID_Cliente'] ?>"><i class="fa-solid fa-trash"></i></a>
                                </td>
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
                    ?> <a class="btn btn-primary active" href="/index.php?controller=clientes&pagina=<?= $paginaBtn;?>"><?= $paginaBtn;?></a> <?php
                }?>
            </div>
        </div>
    </div>

    <!-- Modal -->
      <div class="modal fade" id="agregarProductoModal" data-bs-backdrop="true" data-bs-keyboard="true" tabindex="-1" aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Cliente</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
              <form id="cliForm" action="/index.php?controller=clientes&action=save" class="row" method="POST">
                <div class="row">
                <div class="mb-3 col-6">
                  <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                  <input type="text" required class="form-control" id="exampleFormControlInput1" placeholder="" name="nombre">
                </div>
                <div class="mb-3 col-6">
                  <label for="exampleFormControlInput2" class="form-label">Apellido</label>
                  <input type="text" required class="form-control" id="exampleFormControlInput2" placeholder="" name="apellido">
                </div>
                <div class="mb-3 col-6">
                  <label for="exampleFormControlInput3" class="form-label">Direccion</label>
                  <input type="text" required class="form-control" id="exampleFormControlInput3" placeholder="" name="direccion">
                </div>
                <div class="mb-3 col-6">
                  <label for="exampleFormControlInput4" class="form-label">Telefono</label>
                  <input type="text" required class="form-control" id="exampleFormControlInput4" placeholder="" name="telefono">
                  <input type="text" class="form-control" id="exampleFormControlInput5" placeholder="" name="id" value=0 hidden>
                </div>
                <div class="mb-3 col-6">
                  <label for="exampleFormControlInput3" class="form-label">Correo Electronico</label>
                  <input type="email" required class="form-control" id="exampleFormControlInput6" placeholder="" name="email">
                </div>
                </div>
                <div class="row">
                <div class="mb-3 col-6">
                  <label for="exampleFormControlInput3" class="form-label">Usuario</label>
                  <input type="text" required class="form-control" id="exampleFormControlInput7" placeholder="" name="user">
                </div>
                <div class="mb-3 col-6">
                  <label for="exampleFormControlInput3" class="form-label">Contraseña</label>
                  <input type="password" required class="form-control" id="exampleFormControlInput8" placeholder="" name="pass">
                </div>
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
        $(".btnModificar").click(function(){
            $td = $($(this).closest("tr")).children();

            $('#exampleFormControlInput1').val($td[1].textContent);
            $('#exampleFormControlInput2').val($td[2].textContent);
            $('#exampleFormControlInput3').val($td[3].textContent);
            $('#exampleFormControlInput4').val($td[4].textContent);
            $('#exampleFormControlInput5').val($td[0].textContent);
            
            $('#exampleFormControlInput6').val($(this).data('email'));
            $('#exampleFormControlInput6').attr('disabled',true);
            $('#exampleFormControlInput7').val($(this).data('user'));
            $('#exampleFormControlInput8').val($(this).data('pass'));

        });
    });
</script>