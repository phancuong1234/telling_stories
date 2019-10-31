@extends('index')

@section('content')
<div class="animated fadeIn">
	<div class="row">

		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong class="card-title">ADD Category</strong>
				</div>
				<div class="card-body">
					@if($errors)
					@foreach($errors->all() as $message)
					<div class="alert alert-danger">{{ $message }}</div>
					@endforeach
					@endif
					<div>
						<form action="{{ route('category.add') }}" method="post" accept-charset="utf-8" style="padding-right: 200px;padding-left: 200px;">
							@csrf
							<div class="form-group">
								<label for="post">Name</label>
								<input class="form-control" type="text" name="category" value="" id="name" autofocus>
							</div>
							<div class="modal-footer" style="text-align: center;">
								<a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
								<button type="submit" class="btn btn-success" id="submit">Create</button>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


	</div>
</div><!-- .animated -->
@endsection