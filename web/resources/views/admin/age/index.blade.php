@extends('index')

@section('content')
<div class="animated fadeIn">
	<div class="row">

		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong class="card-title">Data Table</strong>
				</div>
				<div style="margin-left: 20px;margin-top: 20px;">
					<a class="btn btn-info" href="{{ route('age.create') }}">Add</a>
				</div>
				<div class="card-body">
					@if (session('success'))
					<div class="alert alert-success">
						{{session('success')}}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</div>
						@endif
						<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Age</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list as $key => $record)
								<tr>
									<td>{{$record->id}}</td>
									<td>{{$record->age}}</td>
									<td style="display: flex;">
										<a href="{{route('age.edit',$record->id)}}" class="btn btn-warning" role='button'> Edit</a>
										<form action="{{  route('age.destroy',$record->id) }}" method="POST">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button type="submit" class="btn btn-danger" role='button' onclick="return confirm('Bạn có muốn xóa bản ghi này?')" style="margin-left: 5px;"> Delete</button>
										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>


		</div>
	</div><!-- .animated -->


	<!-- Confirm  Delete Modal-->
	{{-- <div class="modal fade" id="delete_category">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h5 class="modal-title tx-blue">DELETE CONFIRMATION</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body delete-body">
					<p>Are You Sure Want To Delete ?</p>
					<input type="hidden" id="id_record" />
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-ok" data-dismiss="modal" onclick="delCategoryRecord('delete_category')">Delete</button>
				</div>
			</div>
		</div>
	</div> --}}
	@endsection