	<?php
	if (isset($con)) {
	?>
		<!-- Modal -->
		<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button style="color: red;" type="button" id="close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar producto</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
							<div id="resultados_ajax"></div>

							<div class="form-group">
								<label for="codCrm" class="col-sm-3 control-label">Código CRM</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="codCrm" name="codCrm" placeholder="Opcional">
								</div>
							</div>

							<div class="form-group">
								<label for="codNeural" class="col-sm-3 control-label">Código Neural</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="codNeural" name="codNeural" placeholder="Opcional" >
								</div>
							</div>

							<div class="form-group">
								<label for="nombProducto" class="col-sm-3 control-label">Nombre</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="nombProducto" name="nombProducto" required>
								</div>
							</div>

							<div class="form-group">
								<label for="nombProdNeural" class="col-sm-3 control-label">Nombre según neural</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="nombProdNeural" name="nombProdNeural" required>
								</div>
							</div>

							<div class="form-group">
								<label for="modelo" class="col-sm-3 control-label">Modelo</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="modelo" name="modelo" required>
								</div>
							</div>

							<div class="form-group">
								<label for="codigoLP" class="col-sm-3 control-label">Código LP</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="codigoLP" name="codigoLP" required>
								</div>
							</div>

							<div class="form-group">
								<label for="codigo_inicio" class="col-sm-3 control-label">Código Garantía</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="codigo_inicio" name="codigo_inicio" required>
								</div>
							</div>

							<div class="form-group">
								<label for="tipo_bater" class="col-sm-3 control-label">Tipo</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="tipo_bater" name="tipo_bater" required>
								</div>
							</div>


							<div class="form-group">
								<label for="estado_bater" class="col-sm-3 control-label">Estado</label>
								<div class="col-sm-8">
									<select class="form-control" id="estado_bater" name="estado_bater" required>
										<option value="">-- Selecciona estado --</option>
										<option value="1" selected>Activo</option>
										<option value="0">Inactivo</option>
									</select>
								</div>
							</div>

					</div>
					<div class="modal-footer">
						<button type="button" id="closeM" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	<?php
	}
	?>