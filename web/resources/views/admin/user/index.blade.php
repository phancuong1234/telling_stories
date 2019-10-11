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
					<a class="btn btn-info" href="{{ route('user.create') }}">Create</a>
				</div>
				<div class="card-body">
					<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>State</th>
								<th>Role</th>
								<th>Created_at</th>
								<th>Updated_at</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@if ($list->count() > DEFAULT_NULL)
							@foreach ($list as $key => $value)
							<tr>
								<td>{{$value->id}}</td>
								<td>{{$value->name}}</td>
								<td>{{$value->email}}</td>
								<td>{{$value->state}}</td>
								<td>{{$value->role_id}}</td>
								<td>{{$value->created_at}}</td>
								<td>{{$value->updated_at}}</td>
								<td style="font-size: 25px;text-align: center;">
									{{-- <a href="{{ route('category.showEdit',$record->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="padding-right: 30px;"></i></a>

									<form action="{{  route('category.delete',$record->id) }}" method="POST">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="submit" class="tt-icon-btn tt-hover-02 tt-small-indent"  onclick="return confirm('Bạn có muốn xóa bản ghi này?')">
											<i class="fa fa-trash-o"></i>
										</button>
									</form> --}}
									</td>
								</tr>
								@endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>


		</div>
	</div><!-- .animated -->
	@endsection
