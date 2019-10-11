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
					<a class="btn btn-info" href="{{ route('category.showAdd') }}">Add</a>
				</div>
				<div class="card-body">
					@if (session('success'))
					<div class="alert alert-success">
						{{session('success')}}
					</div>
					{{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span> --}}
						@endif
						<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list as $key => $record)
								<tr>
									<td>{{$key + 1}}</td>
									<td>{{$record->name}}</td>
									<td style="font-size: 25px;text-align: center;">
										<a href="{{ route('category.showEdit',$record->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="padding-right: 30px;"></i></a>

										<form action="{{  route('category.delete',$record->id) }}" method="POST">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button type="submit" class="tt-icon-btn tt-hover-02 tt-small-indent"  onclick="return confirm('Bạn có muốn xóa bản ghi này?')">
												<i class="fa fa-trash-o"></i>
											</button>
										</form>

										
									{{-- 	<a href="#" data-toggle="modal" data-id="{{ $record->id }}" data-target="#delete_category"><i class="fa fa-trash-o"></i></a>

										<form method="POST" action="{{ route('category.delete',$record->id) }}" id="delete_category{{ $record->id }}">
											@csrf
											<input type="hidden" name="_method" value="DELETE">
										</form> --}}
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
	<script type="text/javascript">

	</script>