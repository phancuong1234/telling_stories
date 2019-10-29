@extends('index')

@section('content')
<style type="text/css" media="screen">
	.fa-toggle-on {
		color: green;
	}
	.fa-toggle-off {
		color: red;
	}
</style>
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
					@if (session('success'))
					<div class="alert alert-success">
						{{session('success')}}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</div>
						@endif
						@if (session('error'))
						<div class="alert alert-warning">
							{{session('error')}}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</div>

							@endif
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
										<td style="text-align: center;font-size: 30px;">
											<a href="javascript:void(0)" onclick="changeStt({{ $value->id }})"  data-url="{{route('user.state',$value->id)}}">
												@if ($value->state == 0)
												<i id="stt_{{ $value->id }}" class="fa fa-toggle-on"></i>
												@endif
												@if ($value->state == 1)
												<i id="stt_{{ $value->id }}" class="fa fa-toggle-off"></i>
												@endif
												<input type="hidden" name="state" value="{{$value->state}}" id= "state_{{$value->id}}">
											</a>
										</td>
										<td>
											@if ($value->role_id == 1)
											ADMIN
											@endif
											@if ($value->role_id == 2)
											MOD
											@endif
											@if ($value->role_id == 3)
											USER
											@endif
										</td>
										<td>{{$value->created_at}}</td>
										<td>{{$value->updated_at}}</td>
										<td style="display: flex;">
											<a href="{{route('user.detail',$value->id)}}" class="btn btn-info" role='button'> Detail</a>
											<a href="{{route('user.edit',$value->id)}}" class="btn btn-warning" role='button' style="margin-left: 5px;"> Edit</a>
											<form action="{{  route('user.destroy',$value->id) }}" method="POST">
												{{ csrf_field() }}
												{{ method_field('DELETE') }}
												<button type="submit" class="btn btn-danger" role='button' onclick="return confirm('Bạn có muốn xóa bản ghi này?')" style="margin-left: 5px;"> Delete</button>
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

		<script type="text/javascript">
			function changeStt(id){
				var state= 0;
				var state_class = $('#stt_'+id).attr('class');
				if(state_class === 'fa fa-toggle-on'){
					state = 0;
				}
				if(state_class === 'fa fa-toggle-off'){
					state = 1;
				}
				$('#stt_'+id).toggleClass('fa-toggle-on').toggleClass("fa-toggle-off");
				$.ajax( {
					method:'POST',
					url: "/admin/user/change_state/"+id,
					data:{
						state: state,
						_token: '{{csrf_token()}}'
					}
				})
				.done(function() {
					alert('success');
				})
				.fail(function() {
					alert('error');
				});
			}
		</script>
		@endsection
