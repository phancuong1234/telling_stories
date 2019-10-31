@extends('index')
@section('css')
<link rel="stylesheet" href="{{ asset('css/upload.css') }}">
</style>
@endsection
@section('content')
<div class="animated fadeIn">
	<div class="row" id="form">

		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong class="card-title">Create User</strong>
				</div>
				<div class="card-body">
					<div class="error">
						
					</div>
					
					<form id= "form_create" action="{{ route('user.create') }}" method="post" accept-charset="utf-8">
						@csrf
						<div class="row">
							<div class="image-upload col-sm-3" style="margin-bottom: 50px;">
								<label for="fileButton">
									<img src="{{ asset('/images/admin.jpg') }}" alt="avatar" class="user-avatar" id="photo" style="border-radius: 50%;width: 150px;height:150%;">
								</label>

								<input id="fileButton" type="file" style="display: none;" />
								<input class="form-control col-sm-8" type="text" name="avatar" value="" id="avatar" style="display: none;">
							</div>
							<div class="col-sm-9 ">
								<div class="row form-group">
									<label class="col-sm-2" for="post">Name</label>
									<input class="form-control col-sm-8" type="text" name="name" value="" placeholder="Name" id= "name">
								</div>
								<div class="row form-group">
									<label class="col-sm-2" for="post">Email</label>
									<input class="form-control col-sm-8" type="email" name="email" value=""placeholder="Email">
								</div>
								<div class="row form-group">
									<label class="col-sm-2" for="post">Password</label>
									<input class="form-control col-sm-8" type="password" name="password" value="" placeholder="password">
								</div>
								<div class="row form-group">
									<label class="col-sm-2" for="post">Gender</label>
									<div class="col-sm-8 form-group">
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" class="custom-control-input" id="male" name="gender" value="1">
											<label class="custom-control-label" for="male">Male</label>
										</div>

										<!-- Default inline 2-->
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" class="custom-control-input" id="female" name="gender" value="2">
											<label class="custom-control-label" for="female">Female</label>
										</div>
									</div>
								</div>
								<div class="row form-group">
									<label class="col-sm-2" for="post">Birthday</label>
									<input class="form-control col-sm-8" type="date" name="birthday" value="">
								</div>
								<div class="row form-group">
									<label class="col-sm-2" for="post">Address</label>
									<input class="form-control col-sm-8" type="text" name="address" value="" placeholder="address">
								</div>
								<div class="row form-group">
									<label class="col-sm-2" for="post">Role</label>
									<!-- Group of default radios - option 1 -->
									<div class="col-sm-10">
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="defaultGroupExample1" name="role" value="1">
											<label class="custom-control-label" for="defaultGroupExample1">Admin</label>
										</div>

										<!-- Group of default radios - option 2 -->
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="defaultGroupExample2" name="role" value="2">
											<label class="custom-control-label" for="defaultGroupExample2">Mod</label>
										</div>

										<!-- Group of default radios - option 3 -->
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="defaultGroupExample3" name="role" value="3">
											<label class="custom-control-label" for="defaultGroupExample3">User</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer" style="justify-content: center;">
							<a href="{{ url()->previous() }}" class="btn btn-danger" id= "cancel">Cancel</a>
							<button type="button" class="btn btn-success" id="btnSubmit">Create
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>


	</div>
</div><!-- .animated -->
@section('js')
<script src="{{ asset('js/upload.js') }}"></script>
@endsection
<script type="text/javascript">
	$(document).ready(function(){
		$("#fileButton").change(function() {
			photo= $('#photo');
			readURL(this,photo);
		});
	});
</script>

<script>
	var button = document.getElementById("btnSubmit");
	button.onclick =  function(){
		var avatar1 = $("input[name=avatar]").val()
		var name1 = $("input[name=name]").val()
		var email1 = $("input[name=email]").val()
		var password1 = $("input[name=password]").val()
		var gender1 = $("input[name='gender']:checked").val()
		var birthday1 = $("input[name=birthday]").val()
		var address1 = $("input[name=address]").val()
		var role1 = $("input[name='role']:checked").val()
		$.ajax({
			url: '{{ route('user.create') }}',
			type: 'POST',
			dataType: 'json',
			data: {

				name: name1,
				email: email1,
				password: password1,
				gender: gender1,
				birthday: birthday1,
				address: address1,
				role: role1,
				avatar: avatar1,
				_token: '{{csrf_token()}}'
			},
		})
		.done(function(result) {

			$('.error').append('<div class="alert alert-danger">{{$errors}}</div>');
			/*foreach($errors->all() as $message)
			<div class="alert alert-danger"></div>
			

			/*var $this = $(this);
			loading($this);*/

    //upload file
   /* var files = document.getElementById("fileButton").files;
    for (var i = 0; i < files.length; i++) {
    	var file = document.getElementById("fileButton").files[i];
    }
    var folder= 'avatar';
    var img= document.getElementById('avatar');
    var form= document.getElementById("form_create");
    upload(file, folder, img, form);*/
})
		.fail(function() {
			alert("error");
		})



	};
</script>
@endsection