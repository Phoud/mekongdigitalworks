	<div class="row">
		<div class="col-md-12">
			@if(Session::has('success'))
			<div class="box-body">
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                        {{ Session::get('success') }}
              </div>
            </div>
			@endif
			@if(Session::has('success_order'))
			<div class="box-body">
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                        {{ Session::get('success_order') }}
              </div>
            </div>
			@endif

			@if(Session::has('warning'))
			<div class="box-body">
			<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Warning!</h4>
                        {{ Session::get('warning') }}
              </div>
            </div>
			@endif

			@if(count($errors) > 0)
			<div class="box-body">
			<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-ban"></i> Error!</h4>
				@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</div>
			</div>
			@endif
		</div>
	</div>
