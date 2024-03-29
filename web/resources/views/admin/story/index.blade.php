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
					<a class="btn btn-info" href="{{ route('story.create') }}">Create</a>
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
									<th>Name</th>
									<th>Photo</th>
									<th>Description</th>
									<th>Category_id</th>
									<th>List_question</th>
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
									<td><img src="{{$value->photo}}" alt="avatar" class="user-avatar" id="avatar" style="width:100px;height:120px;" ></td>
									<td>{{$value->description}}</td>
									<td>{{$value->category_id}}</td>
									<td>{{$value->list_question}}</td>
									<td>{{$value->created_at}}</td>
									<td>{{$value->updated_at}}</td>
									<td style="display: flex;">
										<a href="{{route('story.detail',$value->id)}}" class="btn-info nav-link" role='button'> Detail</a>
										<a href="{{route('story.edit',$value->id)}}" class="btn-warning nav-link" role='button' style="margin-left: 5px;"> Edit</a>
										<form action="{{  route('story.destroy',$value->id) }}" method="POST">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button type="submit" class="btn-danger nav-link" role='button' onclick="return confirm('Bạn có muốn xóa bản ghi này?')" style="margin-left: 5px;"> Delete</button>
										</form>
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
