<div class="row">
	<form class="form" action="index.php?controller=<?= $_GET['controller']?>&action=delete" method="POST">
		<input type="hidden" name="id" value="<?php echo $dataToView["data"][0]; ?>" />
		<div class="alert alert-warning">
			<b>¿Confirma que desea eliminar esta <?= $_GET['controller']?>?:</b>
			<?php $number = 0; foreach ($dataToView["data"] as $key => $value) { 
				if($key == $number){ $number++; }
				else{ ?> <br><i> <?= $key ?> >> <?= $value ?></i> <?php } }?>
		</div>
		<input type="submit" value="Eliminar" class="btn btn-danger"/>
		<a class="btn btn-outline-success" href="index.php?controller=<?= $_GET['controller']?>&action=principal">Cancelar</a>
	</form>
</div>