<div id="modal-image" class="modal in" style="display: none;"><div id="filemanager" class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" id="close" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title">Image Manager</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-5">
					<button type="button" data-toggle="tooltip" title="" id="button-upload" onclick="document.getElementById('files-images').click();" class="btn btn-primary" data-original-title="Upload"><i class="fa fa-upload"></i></button>


					<button type="button" data-toggle="tooltip" title="" id="button-refresh" class="btn btn-default" data-original-title="Refresh"><i class="fa fa-refresh"></i></button>

					<button type="button" data-toggle="tooltip" title="" id="button-delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
					{{-- <button type="button" data-toggle="tooltip" title="" id="button-clear" class="btn btn-default" data-original-title="ClearCache Images"><i class="fa fa-apple"></i></button> --}}

				</div>
				<div class="col-sm-7" style="display: none;">
					<div class="input-group">
						<input type="text" name="search" value="" placeholder="Search.." class="form-control">
						<span class="input-group-btn">
							<button type="button" data-toggle="tooltip" title="" id="button-search" class="btn btn-primary" data-original-title="Search"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
			</div>
			<hr>
					<form id="form-delete-image" method="POST">
					{{ csrf_field() }}
					<div class="row" id="img-upload">
						<!-- here our images display -->
					</div>
					<button id="delete-images-btn"type="submit" style="display:none;"></button>
					</form>
			<br>
		</div>
		<div class="modal-footer"></div>
		<form enctype="multipart/form-data" id="form-upload-images">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="file" name="files[]" multiple="1" style="display: none;" id="files-images" accept="image/*">
		<button id="upload-images-btn" type="submit" style="display:none;"></button>
		</form>
	</div>
</div>
</div>
