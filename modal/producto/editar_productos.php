	<?php
	if (isset($con)) {
	?>
		<!-- Modal -->
		<div class="modal fade" id="modProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" id ="close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar producto</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="post" id="editar_producto" name="editar_producto">
							<div id="resultados_ajax2"></div>

							<input type="hidden" name="mod_id" id="mod_id">

							<div class="form-group">
								<label for="mod_codCrm" class="col-sm-3 control-label">Código CRM</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="mod_codCrm" name="mod_codCrm">
								</div>
							</div>

							<div class="form-group">
								<label for="mod_codNeural" class="col-sm-3 control-label">Código Neural</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="mod_codNeural" name="mod_codNeural">
								</div>
							</div>

							<div class="form-group">
								<label for="mod_nombProducto" class="col-sm-3 control-label">Nombre</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="mod_nombProducto" name="mod_nombProducto" required>
								</div>
							</div>

							<div class="form-group">
								<label for="mod_nombProdNeural" class="col-sm-3 control-label">Nombre según neural</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="mod_nombProdNeural" name="mod_nombProdNeural" required>
								</div>
							</div>

							<div class="form-group">
								<label for="mod_modelo" class="col-sm-3 control-label">Modelo</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="mod_modelo" name="mod_modelo" required>
								</div>
							</div>

							<div class="form-group">
								<label for="mod_codigoLP" class="col-sm-3 control-label">Código LP</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="mod_codigoLP" name="mod_codigoLP" required>
								</div>
							</div>

							<div class="form-group">
								<label for="mod_codigo_inicio" class="col-sm-3 control-label">Código Garantía</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="mod_codigo_inicio" name="mod_codigo_inicio" required>
								</div>
							</div>

							<div class="form-group">
								<label for="mod_tipo_bater" class="col-sm-3 control-label">Tipo</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="mod_tipo_bater" name="mod_tipo_bater" required>
								</div>
							</div>


							<div class="form-group">
								<label for="mod_estado" class="col-sm-3 control-label">Estado</label>
								<div class="col-sm-8">
									<select class="form-control" id="mod_estado" name="mod_estado" required>
										<option value="">-- Selecciona estado --</option>
										<option value="1" selected>Activo</option>
										<option value="0">Inactivo</option>
									</select>
								</div>
							</div>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" id ="closeM" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	<?php
	}
	?>