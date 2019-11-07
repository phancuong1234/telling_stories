@extends('index')

@section('content')
<div class="animated fadeIn">
	<div class="row">

		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong class="card-title">Detail User</strong>
				</div>
				<div class="card-body">
					@if($errors)
					@foreach($errors->all() as $message)
					<div class="alert alert-danger">{{ $message }}</div>
					@endforeach
					@endif
					<form accept-charset="utf-8">
						<div class="row">
							<div class="image-upload col-3" style="margin-bottom: 50px;">
								<label for="fileButton">
									<img @if(!empty($record->avatar)) src="{{$record->avatar}}" @else src="/images/admin.jpg" @endif alt="avatar" class="user-avatar" id="photo" style="border-radius: 50%;width: 150px;height: 150px;">
								</label>
							</div>
							<div class="col-9 ">
								<div class="row form-group">
									<label class="col-2" for="post">Name</label>
									<input class="form-control col-8" type="text" name="name" value="{{$record->name}}" id="name" placeholder="Name" disabled>
								</div>
								<div class="row form-group">
									<label class="col-2" for="post">Email</label>
									<input class="form-control col-8" type="email" name="email" value="{{$record->email}}" id="name" disabled>
								</div>
								<div class="row form-group">
									<label class="col-2" for="post">Gender</label>
									<div class="col-8 form-group">
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" class="custom-control-input" id="male" name="gender" value="1" @if ($record->gender == 1)? checked :0
											@endif disabled>
											<label class="custom-control-label" for="male">Male</label>
										</div>

										<!-- Default inline 2-->
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" class="custom-control-input" id="female" name="gender" value="2" @if ($record->gender == 2)? checked : 0
											@endif disabled>
											<label class="custom-control-label" for="female">Female</label>
										</div>
									</div>
								</div>
								<div class="row form-group">
									<label class="col-2" for="post">Birthday</label>
									<input class="form-control col-8" type="date" name="birthday" value="{{$record->birthday}}" id="name"  disabled>
								</div>
								<div class="row form-group">
									<label class="col-2" for="post">Address</label>
									<input class="form-control col-8" type="text" name="address" value="{{$record->address}}" id="name" disabled>
								</div>
								<div class="row form-group">
									<label class="col-2" for="post">Role</label>
									<!-- Group of default radios - option 1 -->
									<div class="col-10">
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="defaultGroupExample1" name="role" value="1" @if ($record->role_id == 1)? checked :0 @endif disabled>
											<label class="custom-control-label" for="defaultGroupExample1">Admin</label>
										</div>

										<!-- Group of default radios - option 2 -->
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="defaultGroupExample2" name="role" value="2" @if ($record->role_id == 2)? checked :0 @endif disabled>
											<label class="custom-control-label" for="defaultGroupExample2">Mod</label>
										</div>

										<!-- Group of default radios - option 3 -->
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="defaultGroupExample3" name="role" value="3" @if ($record->role_id == 3)? checked :0 @endif disabled>
											<label class="custom-control-label" for="defaultGroupExample3">User</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer" style="justify-content:center;">
							<a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
							<a href="{{ route('profile.edit') }}" class="btn btn-info">Edit</a>
						</div>
					</form>
				</div>
			</div>
		</div>


	</div>
</div><!-- .animated -->
@endsection